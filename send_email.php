<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Erastrus_Group_Sas/Erastus/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/Erastrus_Group_Sas/Erastus/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/Erastrus_Group_Sas/Erastus/PHPMailer-master/PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email_user = htmlspecialchars($_POST['email']);
    $message_user = htmlspecialchars($_POST['message']);

    // Créer une instance de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Serveur SMTP Gmail
        $mail->SMTPAuth   = true;              // Activer l'authentification SMTP
        $mail->Username   = 'n.henripierre@gmail.com'; // Votre adresse Gmail
        $mail->Password   = 'teyp fzka xsbe ttlk';   // Votre mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Activer TLS
        $mail->Port       = 587;  // Port pour TLS

        // Destinataires
        $mail->setFrom(address: 'n.henripierre@gmail.com',  name: 'Erastus Group');
        $mail->addAddress('r.rykydiatta@gmail.com');  // Ajouter un destinataire

        // Contenu de l'email
        $mail->isHTML(true);  // Email au format HTML
        $mail->Subject = 'Nouveau message depuis le formulaire de Erastus Group ';
        
        // Ajouter les données du formulaire dans le corps de l'email
        $mail->Body = "
        <h2>Nouveau message reçu :</h2>
        <p><strong>Prénom :</strong> {$prenom}</p>
        <p><strong>Nom :</strong> {$nom}</p>
        <p><strong>Téléphone :</strong> {$telephone}</p>
        <p><strong>Email :</strong> {$email_user}</p>
        <p><strong>Message :</strong><br>{$message_user}</p>
        ";

        $mail->send();
        echo 'Email envoyé avec succès.';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
    }
} else {
    echo 'Méthode de requête invalide.';
}

?>