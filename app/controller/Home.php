<?php
namespace App\Controller;

use App\Helper\Helper;
use App\Core\EntityManager;
use App\Core\View;
use App\Core\Controller;
/**
 * Class Home
 * @package App\Controller
 */
class Home extends Controller
{
    const DB = 'np';

    private $entityManager;

    /**
     * Films constructor.
     * @param $route_params
     */
    public function __construct($data)
    {
        $this->entityManager = new EntityManager(self::DB);
    }

    /**
     * View homepage
     *
     * @throws \ReflectionException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction()
    {
        $responseData = [];
        /** @var EntityManager $entity */
        $entity = $this->entityManager->createManagedEntity("nova_poshta", 'App\Model\Date');

        if ($_GET && isset($_GET['id']) && is_numeric($_GET['id'])){

            $entry = $this->entityManager->findOne("nova_poshta", [
                'id' => $_GET['id']
            ],'App\Model\Date');

            if ($entry){
                $responseData['entry'] = $entry->object;
            }
        }

        View::renderTemplate('home/index.twig', $responseData);
    }

    /**
     * Handle date range form
     *
     * @throws \ReflectionException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handleFormAction($time_start) : void
    {
        $responseData = [];
        $time_end = microtime(true);

        $execution_time = ($time_end - $time_start);


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['daterange'])) {

            $daterange = explode('-', $_POST['daterange']);
            $startDate = date_create_from_format('Y-m-d', str_replace('/', '-', trim($daterange[0])));
            $endDate = date_create_from_format('m-d-Y', str_replace('.', '-', trim($daterange[1])));

            $data = (object)[
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'diff_date' => $endDate->getTimestamp() - $startDate->getTimestamp(),
                'created' => date('Y-m-d h:m:s'),
                'execution_time' => $execution_time,
            ];

            $entryId = $this->entityManager->create("nova_poshta", $data);

            if ($entryId){
                $entry = $this->entityManager->findOne("nova_poshta", [
                    'id' => $entryId
                ],'App\Model\Date');

                if (isset($_POST['isAjax']) && !empty($_POST['isAjax']) && $_POST['isAjax'] == true){

                    $entry->load();

                    echo json_encode([
                        'id' => $entry->getId(),
                        'diff_date' => Helper::secondsToTime(array($entry->getDiffDate()))
                    ]);
                    exit();
                }else{
                    header('Location: /?id='.$entryId);
                }
            }
        }
    }
}