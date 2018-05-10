<?php

namespace PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use PlatformBundle\Validator\Constraints as CustomAssert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="PlatformBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="L'email existe déja.")
 * @ORM\HasLifecycleCallbacks()
 * 
 * 
 */
class User implements UserInterface, \Serializable {

    const ROLE_DEFAULT = 'ROLE_ETUDIANT';

    public function __construct() {
        $this->creationDate = new \DateTime();
        $this->lastVisit = new \DateTime();
        $this->roles = array('ROLE_ETUDIANT');
        $this->posts = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="salutation", type="string")
     *
     */
    private $salutation;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     * @Assert\NotBlank(
     *     message="Please, enter your firstname",
     *     groups={"Registration", "Profile" }
     * )
     * @Assert\Regex(pattern="/^[a-zA-Z0-9_]{3,255}/",
     *      match=true,
     *      message = "Veuillez entrer 3 caractères minimum."
     * )
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Assert\Regex(
     *   pattern="/^[a-zA-Z0-9_]{3,255}/",
     *   match=true,
     *   message = "Veuillez entrer 3 caractères minimum."
     * )
     */
    private $username;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(message="Veuillez entrer un email valide.")
     * @Assert\NotNull(message="Le champs ne peut être vide.")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     *
     */
    private $password;


    /**
     * @var string
     *
     */
    private $passwordConfirm;

    /**
     * @var string
     *
     * @CustomAssert\CheckPassword()
     *
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @CustomAssert\CheckOldPassword()
     *
     *
     */
    private $oldPassword;

    /**
     * @var string
     *
     * @CustomAssert\CheckNewPassword()
     * @Assert\Regex(pattern="/^(?=.*[a-z])(?=.*\d).{6,}$/i", message="Le nouveau mot de passe requiere un minimum de 6 caractères dont au moins 1 nombre et une lettre")
     */

    private $newPassword;

    /**
     * @var string
     */
    private $newPasswordConfirm;



    /**
     * @var array
     *
     * @ORM\Column(name="job", type="array")
     */
    private $job;

    /**
     * @var array
     *
     * @ORM\Column(name="localisation", type="array")
     */
    private $localisation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastVisit", type="datetime", nullable=true)
     */
    private $lastVisit;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;


    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set salutation
     *
     * @param string $salutation
     *
     * @return User
     */
    public function setSalutation($salutation) {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * Get salutation
     *
     * @return string
     */
    public function getSalutation() {
        return $this->salutation;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }


    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        if (!is_null($password)) {
            $this->password = $password;
        }

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }


      /**
     * Set password
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;

        $this ->password = null;
        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword() {
        return $this->plainPassword;
    }


    /**
     * Set passwordConfirm
     *
     * @param string $password
     *
     * @return User
     */
    public function setPasswordConfirm($password) {
        $this->passwordConfirm = $password;

        return $this;
    }

    /**
     * Get passwordConfirm
     *
     * @return string
     */
    public function getPasswordConfirm() {
        return $this->passwordConfirm;
    }

    /**
     * Set password
     *
     * @param string $oldPassword
     *
     * @return User
     */
    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;

        return $this;
    }


    /**
     * Get password
     *
     * @return string
     */
    public function getOldPassword() {
        return $this->oldPassword;
    }


    /**
     * Set password
     *
     * @param string $newPassword
     *
     * @return User
     */
    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getNewPassword() {
        return $this->newPassword;
    }

    /**
     * Set password
     *
     * @param string $newPasswordConfirm
     *
     * @return User
     */
    public function setNewPasswordConfirm($newPasswordConfirm) {
        $this->$newPasswordConfirm = $newPasswordConfirm;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getNewPasswordConfirm() {
        return $this->newPasswordConfirm;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }



    /**
     * Set job.
     *
     * @param array $job
     *
     * @return User
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job.
     *
     * @return array
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set localisation.
     *
     * @param array $localisation
     *
     * @return User
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation.
     *
     * @return array
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }
    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles) {
        $this->roles = array($roles);

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles() {
        return $this->roles;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return User
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * Set lastVisit
     *
     * @param \DateTime $lastVisit
     *
     * @return User
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    /**
     * Get lastVisit
     *
     * @return \DateTime
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    public function getSalt() {
        /*on peut avoir besoin d'un vrai sel en fonction de l'encodeur*/
        return null;
    }

    /*pour eviter que le password en clair soit sauvegardé n'importe où*/
    public function eraseCredentials() {
        $this ->plainPassword = null ;
    }

    /**
     * @inheritDoc
     */
    public function serialize() {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized) {
        list(
                $this->id,
                $this->username,
                $this->password
                ) = unserialize($serialized);
    }



}
