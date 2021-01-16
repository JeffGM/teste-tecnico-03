<?php


namespace Models\Traits;


trait DataChangeLogTrait {
    /**
     * @ORM\Column(type="datetimetz")
     */
    protected $createdAt;
    /**
     * @ORM\Column(type="datetimetz")
     */
    protected $updatedAt;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(){
        $now = new \DateTime("now");
        $this->updatedAt = $now;
        $this->createdAt = $now;
    }
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate(){
        $this->updatedAt = new \DateTime("now");
    }

    public function getUpdatedAt(){
        return $this->updatedAt;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
}