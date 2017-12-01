<?php
/**
 * Exemple d'utilisation du Webservice Chronopost pour générer une étiquette pdf
 * Docs :
 *  - https://www.gcg-architectes.com/files/projet/c/h/chr_wsv2_5_10/chr_wsv2_5_1058515f3e7c38b.pdf
 *
 * @author Benoit VRIGNAUD <benoit.vrignaud@zaclys.net>
 */

require_once 'Chronopost.php';




$shipping = new Shipping();

$shipping->headerValue->accountNumber = TODO; // Numéro de compte
//$shipping->headerValue->subAccount = '';

// adresse expéditeur
$shipping->shipperValue->shipperAdress1 = '1 rue du Général';
$shipping->shipperValue->shipperAdress2 = '';
$shipping->shipperValue->shipperCity = 'Pom Pom Galli';
$shipping->shipperValue->shipperCivility = 'M';
$shipping->shipperValue->shipperContactName = 'George Abitbol';
$shipping->shipperValue->shipperCountry = 'FR';
$shipping->shipperValue->shipperCountryName = 'FRANCE';
$shipping->shipperValue->shipperEmail = 'George.Abitbol@classe.com';
$shipping->shipperValue->shipperMobilePhone = '0611223344';
$shipping->shipperValue->shipperName = 'George';
$shipping->shipperValue->shipperName2 = 'Abitbol';
$shipping->shipperValue->shipperPhone = '041122344';
$shipping->shipperValue->shipperPreAlert = 0;
$shipping->shipperValue->shipperZipCode = '50000';

// adresse client
$shipping->customerValue->customerAdress1 ='40 RUE JEAN JAURES';
$shipping->customerValue->customerAdress2 = '';
$shipping->customerValue->customerCity ='MONTFRIN';
$shipping->customerValue->customerCivility ='M';
$shipping->customerValue->customerContactName ='Jean MARTIN';
$shipping->customerValue->customerCountry ='FR';
$shipping->customerValue->customerCountryName ='FRANCE';
$shipping->customerValue->customerEmail ='steven@mail.fr';
$shipping->customerValue->customerMobilePhone ='0611223344';
$shipping->customerValue->customerName ='The Journal';
$shipping->customerValue->customerName2 = '';
$shipping->customerValue->customerPhone ='0133333333';
//$shipping->customerValue->customerPreAlert = 0;
$shipping->customerValue->customerZipCode ='72000';
$shipping->customerValue->printAsSender ='N';

// adresse destinataire
$shipping->recipientValue->recipientAdress1 = '40 RUE JEAN JAURES';
//$shipping->recipientValue->recipientAdress2 = '';
$shipping->recipientValue->recipientCity = 'MONTFRIN';
$shipping->recipientValue->recipientContactName = 'CLIENT';
$shipping->recipientValue->recipientCountry = 'FR';
$shipping->recipientValue->recipientCountryName = 'FRANCE';
$shipping->recipientValue->recipientEmail = 'test@gmail.com';
$shipping->recipientValue->recipientMobilePhone = '06123456';
$shipping->recipientValue->recipientName = 'CLIENTname';
//$shipping->recipientValue->recipientName2 = '';
$shipping->recipientValue->recipientPhone = '0455667788';
//$shipping->recipientValue->recipientPreAlert = 0;
$shipping->recipientValue->recipientZipCode = '69190';
$shipping->recipientValue->recipientCivility = 'M';

// Références expéditeur et destinataire, code barre client
//$shipping->refValue->shipperRef = $commandeNo;              // Référence Expéditeur (ex: '000000000000001')
//$shipping->refValue->recipientRef = $articleNo;             // Référence Destinataire (ex: '24')
//$shipping->refValue->customerSkybillNumber = '123456789';


// Caractéristique de colis : poids, produit, ...
$shipping->skybillValue->productCode = '86';            // Code Produit Chronopost
$shipping->skybillValue->shipDate = date('c');          // Date d'expédition
$shipping->skybillValue->shipHour = date('G');
$shipping->skybillValue->weight = 2;
$shipping->skybillValue->service = '0';                 // Jour de livraison
$shipping->skybillValue->objectType = 'MAR';            // Type de colis (DOC/MAR)
//$shipping->skybillValue->bulkNumber = 1;              // Nombre total de colis
//$shipping->skybillValue->codCurrency = 'EUR';           // Devise  du  Retour  Express de paiement EUR (Euro) par defaut
//$shipping->skybillValue->codValue = 0;                // Valeur  Retour  Express  de paiement
//$shipping->skybillValue->customsCurrency = 'EUR';       // Devise   de   la   valeur déclarée en douane
//$shipping->skybillValue->customsValue = 0;              // Valeur déclarée en douane
//$shipping->skybillValue->insuredCurrency = 'EUR';       // Devise   de   la   valeur assurée
//$shipping->skybillValue->insuredValue = 0;
//$shipping->skybillValue->masterSkybillNumber = '?';
//$shipping->skybillValue->portCurrency = 'EUR';
//$shipping->skybillValue->portValue = 0;
//$shipping->skybillValue->skybillRank = 1;
//$shipping->skybillValue->height = $height;            // ex : '10'
///$shipping->skybillValue->length = $length;           // ex : '20'
//$shipping->skybillValue->width = $width;              // ex : '30'

$shipping->password = 'TODO';               // Mot de passe correspondant au numéro de compte




$client = new Chronopost();

try {
    $result = $client->genereEtiquette($shipping);
} catch (SoapFault $soapFault) {
    //var_dump($soapFault);
    exit($soapFault->faultstring);
}

if ($result->return->errorCode) {
    echo 'Erreur n° ' . $result->return->errorCode . ' : ' . $result->return->errorMessage;
    //var_dump($result);
} else {
    // écriture dans un fichier pdf
    $fp = fopen('data.pdf', 'w');
    fwrite($fp, $result->return->skybill);
    fclose($fp);
    echo 'OK';
}
