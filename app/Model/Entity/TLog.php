<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class TLog
 *
 * @since 2.0
 *
 * @Entity(table="t_log")
 */
class TLog extends Model
{
    /**
     * 日志ID
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 操作用户
     *
     * @Column()
     *
     * @var string|null
     */
    private $username;

    /**
     * 操作内容
     *
     * @Column()
     *
     * @var string|null
     */
    private $operation;

    /**
     * 耗时
     *
     * @Column()
     *
     * @var float|null
     */
    private $time;

    /**
     * 操作方法
     *
     * @Column()
     *
     * @var string|null
     */
    private $method;

    /**
     * 方法参数
     *
     * @Column()
     *
     * @var string|null
     */
    private $params;

    /**
     * 操作者IP
     *
     * @Column()
     *
     * @var string|null
     */
    private $ip;

    /**
     * 操作地点
     *
     * @Column()
     *
     * @var string|null
     */
    private $location;

    /**
     * 
     *
     * @Column(name="created_at", prop="createdAt")
     *
     * @var string|null
     */
    private $createdAt;

    /**
     * 
     *
     * @Column(name="updated_at", prop="updatedAt")
     *
     * @var string|null
     */
    private $updatedAt;


    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string|null $username
     *
     * @return void
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string|null $operation
     *
     * @return void
     */
    public function setOperation(?string $operation): void
    {
        $this->operation = $operation;
    }

    /**
     * @param float|null $time
     *
     * @return void
     */
    public function setTime(?float $time): void
    {
        $this->time = $time;
    }

    /**
     * @param string|null $method
     *
     * @return void
     */
    public function setMethod(?string $method): void
    {
        $this->method = $method;
    }

    /**
     * @param string|null $params
     *
     * @return void
     */
    public function setParams(?string $params): void
    {
        $this->params = $params;
    }

    /**
     * @param string|null $ip
     *
     * @return void
     */
    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @param string|null $location
     *
     * @return void
     */
    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    /**
     * @param string|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param string|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * @return float|null
     */
    public function getTime(): ?float
    {
        return $this->time;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @return string|null
     */
    public function getParams(): ?string
    {
        return $this->params;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

}
