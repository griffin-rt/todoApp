<?php
/*
 * Command to fetch data of last 3 days from nasa api
 *
 * @author Pawan Raj Murarka< pawanrajmurarka@gmail.com >
 */

namespace McMaklerBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;
use McMaklerBundle\Entity\Neo;

class FetchRecentCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('nasa:fetch-three')
            ->setDescription('Fetches data of last 3 days from nasa api');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try{
            $container = $this->getContainer();
            $data = $this->getData($container);
            $storageCount = $this->getNeoInfo($data,$container);
            print "Neo count=".$storageCount."\n";
        }catch (\Exception $e){
            print $e->getMessage()."\n";
        }
    }


    protected function getData($container)
    {
        $logger = $container->get("monolog.logger.nasa_neo");
        $requestUrl = $container->getParameter("neo_fetch_url");
        $apiKey = $container->getParameter("api_key");
        $date = new \DateTime();
        $today = $date->format("Y-m-d");
        $earlier = $date->modify('-2 days')->format("Y-m-d");

        $client = new Client();
        $requestObj = $client->request('GET', $requestUrl,
            ['query' => [
                'start_date' => $today,
                'end_date' => $earlier,
                'detailed' => 'false',
                'api_key' => $apiKey
            ]
            ]
        );

        $data = $requestObj->getBody()->getContents();
        $logger->debug($data);
        $data = json_decode($data, true);
        return $data;
    }

    protected function getNeoInfo($data,$container)
    {
        $dataCount = $data['element_count'];
        $neoDataAll = $data['near_earth_objects'];
        $neoDataStore = array();
        $neoTemp = array();
        foreach ($neoDataAll as $date => $info) {
            foreach ($info as $key => $value){
                $neoTemp['date'] = $date;
                $neoTemp['neo_reference_id'] = $value['neo_reference_id'];
                $neoTemp['name'] = $value['name'];
                $neoTemp['speed'] = $value['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'];
                $neoTemp['is_potentially_hazardous_asteroid'] = $value['is_potentially_hazardous_asteroid'];
                $neoDataStore[] = $neoTemp;
            }
        }

        $this->storeInfo($neoDataStore,$container);
        return $dataCount;
    }

    protected function storeInfo($neoDataStore,$container){
        $doctrine = $container->get('doctrine');
        $em = $doctrine->getManager();
        $neoInstance = new Neo();

        foreach ($neoDataStore as $key=>$item){
            $neoObj = clone $neoInstance;
            $neoObj->setNeoReferenceId($item['neo_reference_id']);
            $neoObj->setName($item['name']);
            $neoObj->setSpeed($item['speed']);
            $neoObj->setDate(new \DateTime($item['date']));
            $neoObj->setIsPotentiallyHazardousAsteroid($item['is_potentially_hazardous_asteroid']);
            $em->persist($neoObj);
        }
        $em->flush();
    }
}