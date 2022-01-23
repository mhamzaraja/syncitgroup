<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Api\Data;

interface FormdataInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const FORMDATA_ID = 'formdata_id';
    const SEX = 'sex';
    const Email = 'email';
    const NAME = 'name';
    const IP_ADDRESS = 'ip_address';
    const AGE = 'age';
    const MESSAGE = 'message';

    /**
     * Get formdata_id
     * @return string|null
     */
    public function getFormdataId();

    /**
     * Set formdata_id
     * @param string $formdataId
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setFormdataId($formdataId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Syncitgroup\Sgform\Api\Data\FormdataExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Syncitgroup\Sgform\Api\Data\FormdataExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Syncitgroup\Sgform\Api\Data\FormdataExtensionInterface $extensionAttributes
    );

    /**
     * Get age
     * @return string|null
     */
    public function getAge();

    /**
     * Set age
     * @param string $age
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setAge($age);

    /**
     * Get sex
     * @return string|null
     */
    public function getSex();

    /**
     * Set sex
     * @param string $sex
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setSex($sex);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setMessage($message);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setEmail($email);

    /**
     * Get ip_address
     * @return string|null
     */
    public function getIpAddress();

    /**
     * Set ip_address
     * @param string $ipAddress
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     */
    public function setIpAddress($ipAddress);
}

