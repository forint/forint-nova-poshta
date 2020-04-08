<?php
namespace App\Model;

use App\Core\Entity;
use App\Core\EntityManager;
use Braintree\Exception;

/**
 * Class Tasks
 * @package App\Model
 */
class Date extends Entity
{
    private $id;
    private $ipAddress;
    private $startDate;
    private $endDate;
    private $diffDate;
    private $executionTime;
    private $createdDate;
    private $status;

    public function __construct()
    {
        $entityManager = new EntityManager('np');
        parent::__construct($entityManager, 'nova_poshta');
    }

    /**
     * Get id
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * Set id
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get execution time
     * @return float
     */
    public function getExecutionTime(): float
    {
        return (float)$this->executionTime;
    }

    /**
     * Set execution time
     * @param float $executionTime
     */
    public function setExecutionTime(float $executionTime): void
    {
        $this->executionTime = $executionTime;
    }

    /**
     * Get ip address
     * @return string
     */
    public function getIpAddress(): string
    {
        return (string)$this->ipAddress;
    }

    /**
     * Set ip address
     * @param string $ipAddress
     */
    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }
    /**
     * Get start date
     */
    public function getStartDate(): string
    {
        return (string)$this->startDate;
    }

    /**
     * Set start date
     * @param string $startDate
     */
    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }
    /**
     * Get end date
     */
    public function getEndDate(): string
    {
        return (string)$this->endDate;
    }

    /**
     * Set end date
     * @param $endDate
     */
    public function setEndDate(string $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * Get diff date
     */
    public function getDiffDate(): string
    {
        return (string)$this->diffDate;
    }

    /**
     * Set diff date
     * @param $diffDate
     */
    public function setDiffDate(string $diffDate): void
    {
        $this->diffDate = $diffDate;
    }

    /**
     * Get created date
     */
    public function getCreatedDate(): string
    {
        return (string)$this->createdDate;
    }

    /**
     * Set created date
     * @param $createdDate
     */
    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    /**
     * Generate ip address
     * @return string
     */
    public function generateIpAddress(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return (string)$ip;
    }

    /**
     * @param $object
     */
    public function init($object)
    {
        $this->object = (object)$object;

        $this->setId($object->id);
        $this->setIpAddress($object->ip_address);
        $this->setStartDate($object->start_date);
        $this->setEndDate($object->end_date);
        $this->setDiffDate($object->diff_date);
        $this->setCreatedDate($object->created);
    }
}