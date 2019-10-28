<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class TUser
 *
 * @since 2.0
 *
 * @Entity(table="t_user")
 */
class TUser extends Model
{
    /**
     * 用户ID
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 用户名
     *
     * @Column()
     *
     * @var string
     */
    private $username;

    /**
     * 姓名
     *
     * @Column(name="real_name", prop="realName")
     *
     * @var string
     */
    private $realName;

    /**
     * 密码
     *
     * @Column(hidden=true)
     *
     * @var string
     */
    private $password;

    /**
     * 部门ID
     *
     * @Column(name="dept_id", prop="deptId")
     *
     * @var int|null
     */
    private $deptId;

    /**
     * 邮箱
     *
     * @Column()
     *
     * @var string|null
     */
    private $email;

    /**
     * 联系电话
     *
     * @Column()
     *
     * @var string|null
     */
    private $mobile;

    /**
     * 状态 0锁定 1有效
     *
     * @Column()
     *
     * @var string
     */
    private $status;

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
     * 最近访问时间
     *
     * @Column(name="last_login_time", prop="lastLoginTime")
     *
     * @var string|null
     */
    private $lastLoginTime;

    /**
     * 性别 0男 1女 2保密
     *
     * @Column()
     *
     * @var string|null
     */
    private $sex;

    /**
     * 描述
     *
     * @Column()
     *
     * @var string|null
     */
    private $description;

    /**
     * 用户头像
     *
     * @Column()
     *
     * @var string|null
     */
    private $avatar;


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
     * @param string $username
     *
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string $realName
     *
     * @return void
     */
    public function setRealName(string $realName): void
    {
        $this->realName = $realName;
    }

    /**
     * @param string $password
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param int|null $deptId
     *
     * @return void
     */
    public function setDeptId(?int $deptId): void
    {
        $this->deptId = $deptId;
    }

    /**
     * @param string|null $email
     *
     * @return void
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string|null $mobile
     *
     * @return void
     */
    public function setMobile(?string $mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * @param string $status
     *
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
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
     * @param string|null $lastLoginTime
     *
     * @return void
     */
    public function setLastLoginTime(?string $lastLoginTime): void
    {
        $this->lastLoginTime = $lastLoginTime;
    }

    /**
     * @param string|null $sex
     *
     * @return void
     */
    public function setSex(?string $sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @param string|null $description
     *
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string|null $avatar
     *
     * @return void
     */
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getRealName(): ?string
    {
        return $this->realName;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return int|null
     */
    public function getDeptId(): ?int
    {
        return $this->deptId;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
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

    /**
     * @return string|null
     */
    public function getLastLoginTime(): ?string
    {
        return $this->lastLoginTime;
    }

    /**
     * @return string|null
     */
    public function getSex(): ?string
    {
        return $this->sex;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

}
