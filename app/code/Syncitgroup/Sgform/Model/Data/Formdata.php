<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model\Data;

use Syncitgroup\Sgform\Api\Data\FormdataInterface;

class Formdata extends \Magento\Framework\Api\AbstractExtensibleObject implements FormdataInterface
{

    /**
     * Get formdata_id
     * @return string|null
     */
    public function getFormdataId()
    {
        return $this->_get(self::FORMDATA_ID);
    }

    /**
     * Set formdata_id
     * @param string $formdataId
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setFormdataId($formdataId)
    {
        return $this->setData(self::FORMDATA_ID, $formdataId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Syncitgroup\Sgform\Api\Data\FormdataExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Syncitgroup\Sgform\Api\Data\FormdataExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Syncitgroup\Sgform\Api\Data\FormdataExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get age
     * @return string|null
     */
    public function getAge()
    {
        return $this->_get(self::AGE);
    }

    /**
     * Set age
     * @param string $age
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setAge($age)
    {
        return $this->setData(self::AGE, $age);
    }

    /**
     * Get sex
     * @return string|null
     */
    public function getSex()
    {
        return $this->_get(self::SEX);
    }

    /**
     * Set sex
     * @param string $sex
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setSex($sex)
    {
        return $this->setData(self::SEX, $sex);
    }

    /**
     * Get message
     * @return string|null
     */
    public function getMessage()
    {
        return $this->_get(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::Email);
    }

    /**
     * Set email
     * @param string $email
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::Email, $email);
    }

    /**
     * Get ip_address
     * @return string|null
     */
    public function getIpAddress()
    {
        return $this->_get(self::IP_ADDRESS);
    }

    /**
     * Set ip_address
     * @param string $ipAddress
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setIpAddress($ipAddress)
    {
        return $this->setData(self::IP_ADDRESS, $ipAddress);
    }
}

