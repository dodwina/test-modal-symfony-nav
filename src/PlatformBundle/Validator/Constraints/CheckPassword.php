<?php

namespace PlatformBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckPassword extends Constraint {

    public $messageMatch = "Le mots de passe n'est pas identique.";
    public $messageRepeatPassword = "Veuillez répeter le mot de passe";
    public $emptyMessage = "Le mot de passe ne peut être vide.";
    public $minMessage = "Veuillez rentrer un mot de passe de 2 caractères minimum.";
    public $maxMessage = "Le mot de passe est trop long";

    public function validatedBy() {
        return 'validatorCheckPassword';
    }
    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }

}
