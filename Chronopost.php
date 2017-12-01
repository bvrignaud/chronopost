<?php
/**
 * Implémentation partielle du webservice Chronopost
 * @author Benoit VRIGNAUD <benoit.vrignaud@zaclys.net>
 */


/**
 * Paramètres Enlèvement Sur Demande
 */
class EsdValue
{
  public $closingDateTime;          // dateTime
  public $height;                   // float
  public $length;                   // float
  public $retrievalDateTime;        // dateTime
  public $shipperBuildingFloor;     // string
  public $shipperCarriesCode;       // string
  public $shipperServiceDirection;  // string
  public $specificInstructions;     // string
  public $width;                    // float
}


class HeaderValue
{
    /**
     * Numéro de compte
     * @var int
     */
    public $accountNumber;

    public $idEmit = 'CHRFR';   // Valeur fixe : CHRFR (string)
    public $identWebPro;        // string
    public $subAccount;         // Numéro de sous-compte (int)
}


class ShipperValue
{
  public $shipperAdress1;       // string
  public $shipperAdress2;       // string
  public $shipperCity;          // string
  public $shipperCivility;      // string
  public $shipperContactName;   // string
  public $shipperCountry;       // string
  public $shipperCountryName;   // string
  public $shipperEmail;         // string
  public $shipperMobilePhone;   // string
  public $shipperName;          // string
  public $shipperName2;         // string
  public $shipperPhone;         // string

  /**
   * Type de préalerte (MAS)<ul>
   *    <li>0 : pas de préalerte</li>
   *    <li>11 : abonnement tracking expéditeur</li></ul>
   * @var int
   */
  public $shipperPreAlert;

  public $shipperZipCode;       // string
}


class CustomerValue
{
    public $customerAdress1;        // string
    public $customerAdress2;        // string
    public $customerCity;           // string
    public $customerCivility;       // string
    public $customerContactName;    // string
    public $customerCountry;        // string
    public $customerCountryName;    // string
    public $customerEmail;          // string
    public $customerMobilePhone;    // string
    public $customerName;           // string
    public $customerName2;          // string
    public $customerPhone;          // string

    /**
     * Type de préalerte (Non utilisé pour le moment)
     * @var int
     */
    public $customerPreAlert;

    public $customerZipCode;        // string
}


class RecipientValue
{
    public $recipientAdress1;       // string
    public $recipientAdress2;       // string
    public $recipientCity;          // string
    public $recipientContactName;   // string
    public $recipientCountry;       // string
    public $recipientCountryName;   // string
    public $recipientEmail;         // string
    public $recipientMobilePhone;   // string
    public $recipientName;          // string
    public $recipientName2;         // string
    public $recipientPhone;         // string

    /**
     * Type de préalerte ( MAS )<ul>
     * <li>0 : pas de préalerte</li>
     * <li>22 : préalerte mail destinataire</li></ul>
     * @var int
     */
    public $recipientPreAlert;

    public $recipientZipCode;       // string
}


class RefValue
{
    /**
     * Numéro de colis client
     * Ce numéro de colis s’il est renseigné apparaitera sous forme de code barre sur
     * l’étiquette si celle-ci est de format A4 (champs mode positionné à SPD ou à PDF)
     * ou en format ZPL pour imprimante thermique (champs mode positionné à Z2D).
     * A noter que ce numéro sera automatiquement tronqué s’il dépasse 15 caractères.
     * @var string
     */
    public $customerSkybillNumber;

    //public $PCardTransactionNumber; // string

    /**
     * Référence Destinataire
     * Champ libre (imprimable sur la facture).
     * Cette valeur peut être utilisée ensuite comme critère de recherche dans le suivi.
     * Dans le cas des produits Chrono Relais (86), Chrono Relais 9 (80), Chrono Relais Europe (3T)
     *  et Chrono Zengo Relais 13 (3K) ce champs doit être rempli avec le code du point relais.
     *
     * @var string
     */
    public $recipientRef;

    /**
     * Référence Expéditeur
     * Champ libre (imprimable sur la facture).
     * Cette valeur peut être utilisée ensuite comme critère de recherche dans le suivi.
     * @var string
     */
    public $shipperRef; // string
}


/**
 * Caractéristique de colis : poids, produit, ...
 */
class SkybillValue
{
    public $bulkNumber = 1;         // Nombre total de colis
    public $codCurrency = 'EUR';    // Devise  du  Retour  Express de paiement EUR (Euro) par defaut (string)
    public $codValue;               // Valeur  Retour  Express  de paiement (int)
    public $content1;               // Détail contenu du colis 1 (string)
    public $content2;               // Détail contenu du colis 2 (string)
    public $content3;               // Détail contenu du colis 3 (string)
    public $content4;               // Détail contenu du colis 4 (string)
    public $content5;               // Détail contenu du colis 5 (string)
    public $customsCurrency;        // Devise   de   la   valeur déclarée en douane (string)
    public $customsValue;           // Valeur déclarée en douane (int)
    public $evtCode = 'DC';         // Code  événement  de  suivi Chronopost - Champ fixe : DC (string)
    public $insuredCurrency;        // Devise   de   la   valeur assurée (string)
    public $insuredValue;           // Valeur assurée (int)

    /**
     * Type de colis :
     *      DOC : Document
     *      MAR : Marchandise
     * @var string
     */
    public $objectType;

    public $portCurrency;           // string
    public $portValue;              // float

    /**
     * Code Produit Chronopost<ul>
     * <li>0 : Chrono Retrait Bureau</li>
     * <li>1 : Chrono 13</li>
     * <li>...</li>
     * <li>86 : Chrono Relais</li>
     * <li>...</li></ul>cf ANNEXE 8 : CODES PRODUITS ACCEPTES PAR LE WS SHIPPING
     * @var string
     */
    public $productCode;

    /**
     * Jour de livraison<ul>
     * <li>0 - Normal</li>
     * <li>1 - Livraison  lundi (uniquement  pour  les codes produits nationaux)</li>
     * <li>6 - Livraison  samedi (uniquement  pour  les codes produits nationaux)</li>
     * </ul>
     * @var string
     */
    public $service;

    public $shipDate;               // Date d'expédition (dateTime)

    /**
     * Heure d'expédition
     * Heure de  génération  de  l'envoi  (heure  courante), doit être compris entre 0 et 23
     * @var int
     */
    public $shipHour;

    public $skybillRank;            // string

    /**
     * Poids
     * @var float
     */
    public $weight;

    /**
     * Unité de poids
     *      par defaut: KGM (Kilogrammes)
     *      Sous-ensemble  de  la  recommandation 20 de l’UN/ECE
     * @var string
     */
    public $weightUnit = 'KGM';
}


/**
 * Indique sous quelle forme doit être récupérée l’étiquette.
 */
class SkybillParamsValue
{
    public $mode = 'PDF'; // string
}

class Shipping
{
    /**
     * Paramètres Enlèvement Sur Demande
     * @var EsdValue
     */
    //public $esdValue;

    /** @var HeaderValue */
    public $headerValue;

    /**
     * Adresse expéditeur
     * @var ShipperValue
     */
    public $shipperValue;

    /**
     * Adresse du client
     * @var CustomerValue
     */
    public $customerValue;

    /**
     * Adresse du destinataire
     * @var recipientValue
     */
    public $recipientValue;

    /**
     * Références expéditeur et destinataire, code barre client
     * @var RefValue
     */
    public $refValue;

    /**
     * Caractéristique de colis : poids, produit, ...
     * @var SkybillValue
     */
    public $skybillValue;

    /**
     * @var skybillParamsValue
     */
    public $skybillParamsValue;

    /**
     * Mot de passe correspondant au numéro de compte
     * @var string
     */
    public $password = '';

    public function __construct()
    {
        //$this->esdValue = new EsdValue();
        $this->headerValue = new HeaderValue();
        $this->shipperValue = new ShipperValue();
        $this->customerValue = new CustomerValue();
        $this->recipientValue = new RecipientValue();
        $this->refValue = new refValue();
        $this->skybillValue = new SkybillValue();
        $this->skybillParamsValue = new SkybillParamsValue();
    }
}

class ShippingResponse
{
    public $return; // resultExpeditionValue
}


class Chronopost
{
    const WSDL_SHIPPING_SERVICE = "https://ws.chronopost.fr/shipping-cxf/ShippingServiceWS?wsdl";

    public function __construct()
    {
        // Check is SOAP is available
        if (!extension_loaded('soap')) {
            die('The SOAP extension is not available or configured on the server ; The module will not work without this extension ! Please contact your host to activate it in your PHP installation.');
        }
    }


    /**
     * Génère une étiquette
     *
     * @param Shipping $parameters
     * @return ShippingResponse
     * @throws SoapFault
     */
    public function genereEtiquette(Shipping $params)
    {
        $client_ch = new soapClient(self::WSDL_SHIPPING_SERVICE);
        $client_ch->soap_defencoding = 'UTF-8';
        $client_ch->decode_utf8 = false;

        return $client_ch->shipping($params);
    }
}
