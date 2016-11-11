<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\base\Security;
use DateTime;

/**
 * This is the model class for table "Claim".
 *
 * @property integer $ClaimID
 * @property integer $ApplicationID
 * @property integer $CompanyID
 * @property integer $ABRFID
 * @property integer $ParkingLocationID
 * @property integer $ClaimEventID
 * @property string $ClaimNumber
 * @property string $PolicyNumber
 * @property string $InternalReference
 * @property string $IncidentDate
 * @property integer $AutoMakeID
 * @property integer $AutoModelID
 * @property integer $AutoCategoryID
 * @property string $AutoVehicleType
 * @property string $AutoMakeModel_Custom
 * @property integer $AutoYear
 * @property string $AutoVIN
 * @property string $AutoLicense
 * @property integer $AutoMileage
 * @property string $AutoColor
 * @property integer $AutoThreeStage
 * @property integer $AutoRental
 * @property integer $AutoDrivable
 * @property integer $CollisionEstimate
 * @property string $IncidentDescription
 * @property string $Customer_FirstName
 * @property string $Customer_LastName
 * @property string $Customer_DriversLicense
 * @property string $Customer_Email
 * @property string $Customer_Phone
 * @property string $Customer_Phone2
 * @property string $Customer_Address
 * @property string $Customer_Address2
 * @property string $Customer_City
 * @property string $Customer_State
 * @property string $Customer_Zip
 * @property string $Customer_Longitude
 * @property string $Customer_Latitude
 * @property string $Customer_Description
 * @property string $Customer_InsuranceCompany
 * @property string $Customer_InsurancePolicyNumber
 * @property string $Customer_InsuranceAgentName
 * @property string $Customer_InsurancePhone
 * @property string $Customer_InsuranceEmail
 * @property string $Estimate_Dollars
 * @property string $Estimate_Misc
 * @property string $Estimate_Hours
 * @property integer $Estimate_RepairDays
 * @property integer $Estimate_RentalDays
 * @property string $Estimate_RentalCost
 * @property integer $Repaired
 * @property integer $Complete
 * @property integer $Archived
 * @property integer $Deleted
 * @property integer $EstimateBy_UserID
 * @property integer $CreatedBy_UserID
 * @property string $Created_Time
 * @property integer $LastActionBy_UserID
 * @property string $LastAction_Time
 */
class Claim extends \yii\db\ActiveRecord
{

    public $Make;
    public $Model;
    public $Event;
    public $Auto;
    public $LotName;
    public $Company;
    public $basePath;
    public $thumbnailPath;
    public $mainPath;
    public $Customer_DisplayAddress;
    public $allowedFileTypes = [
        "image" => ["jpg", "jpeg", "png"],
        "video" => ["mp4", "mov", "webm"]
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Claim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ApplicationID', 'CompanyID', 'ABRFID', 'ParkingLocationID', 'ClaimEventID', 'AutoMakeID', 'AutoModelID', 'AutoCategoryID', 'AutoYear', 'AutoMileage', 'AutoThreeStage', 'AutoRental', 'AutoDrivable', 'CollisionEstimate', 'Estimate_RepairDays', 'Estimate_RentalDays', 'Subrogation', 'Repaired', 'Complete', 'Archived', 'Deleted', 'EstimateBy_UserID', 'CreatedBy_UserID', 'LastActionBy_UserID'], 'integer'],
            #[['ParkingLocationID', 'AutoCategoryID', 'AutoVehicleType', 'AutoMakeModel_Custom', 'AutoDrivable', 'CollisionEstimate', 'IncidentDescription', 'Customer_Longitude', 'Customer_Latitude', 'Customer_Description', 'Customer_InsuranceCompany', 'Customer_InsurancePolicyNumber', 'Customer_InsuranceAgentName', 'Customer_InsurancePhone', 'Customer_InsuranceEmail', 'Estimate_Misc', 'Estimate_RepairDays', 'Estimate_RentalDays', 'Repaired', 'Deleted'], 'required'],
            [['Auto', 'IncidentDate', 'Created_Time', 'LastAction_Time', 'ClaimID', 'Customer_FirstName', 'Customer_LastName', 'ClaimEventID'], 'safe'],
            [['IncidentDescription', 'Customer_Description'], 'string'],
            [['Customer_Longitude', 'Customer_Latitude', 'Estimate_Dollars', 'Estimate_Misc', 'Estimate_Hours', 'Estimate_RentalCost'], 'number'],
            [['ClaimNumber', 'InternalReference', 'Customer_FirstName', 'Customer_LastName', 'Customer_DriversLicense', 'Customer_Email', 'Customer_Phone', 'Customer_Phone2', 'Customer_Address', 'Customer_Address2', 'Customer_City', 'Customer_State', 'Customer_Zip', 'Customer_InsuranceCompany', 'Customer_InsurancePolicyNumber', 'Customer_InsuranceAgentName', 'Customer_InsurancePhone', 'Customer_InsuranceEmail'], 'string', 'max' => 255],
            [['PolicyNumber', 'AutoVIN', 'AutoLicense', 'AutoColor', 'Company'], 'string', 'max' => 32],
            [['Auto', 'AutoVehicleType', 'AutoMakeModel_Custom', 'LotName'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ClaimID' => 'Claim #',
            'ApplicationID' => 'Application ID',
            'CompanyID' => 'Company ID',
            'ABRFID' => 'Abrfid',
            'ParkingLocationID' => 'Parking Location ID',
            'ClaimEventID' => 'Status',
            'ClaimNumber' => 'Claim Number',
            'PolicyNumber' => 'Policy Number',
            'InternalReference' => 'Internal Reference',
            'IncidentDate' => 'Incident Date',
            'AutoMakeID' => 'Auto Make ID',
            'AutoModelID' => 'Auto Model ID',
            'AutoCategoryID' => 'Auto Category ID',
            'AutoVehicleType' => 'Auto Vehicle Type',
            'AutoMakeModel_Custom' => 'Auto Make Model  Custom',
            'AutoYear' => 'Auto Year',
            'AutoVIN' => 'Auto Vin',
            'AutoLicense' => 'Auto License',
            'AutoMileage' => 'Auto Mileage',
            'AutoColor' => 'Auto Color',
            'AutoThreeStage' => 'Auto Three Stage',
            'AutoRental' => 'Auto Rental',
            'AutoDrivable' => 'Auto Drivable',
            'CollisionEstimate' => 'Collision Estimate',
            'IncidentDescription' => 'Incident Description',
            'Customer_FirstName' => 'First Name',
            'Customer_LastName' => 'Last Name',
            'Customer_DriversLicense' => 'Drivers License',
            'Customer_Email' => 'Email',
            'Customer_Phone' => 'Phone (Best)',
            'Customer_Phone2' => 'Phone (Other)',
            'Customer_Address' => 'Address',
            'Customer_Address2' => 'Address2',
            'Customer_City' => 'City',
            'Customer_State' => 'State',
            'Customer_Zip' => 'Zip',
            'Customer_Longitude' => 'Customer  Longitude',
            'Customer_Latitude' => 'Customer  Latitude',
            'Customer_Description' => 'Customer  Description',
            'Customer_InsuranceCompany' => 'Customer  Insurance Company',
            'Customer_InsurancePolicyNumber' => 'Customer  Insurance Policy Number',
            'Customer_InsuranceAgentName' => 'Customer  Insurance Agent Name',
            'Customer_InsurancePhone' => 'Customer  Insurance Phone',
            'Customer_InsuranceEmail' => 'Customer  Insurance Email',
            'Estimate_Dollars' => 'Estimate  Dollars',
            'Estimate_Misc' => 'Miscellaneous Claim Costs',
            'Estimate_Hours' => 'Estimate  Hours',
            'Estimate_RepairDays' => 'Estimate  Repair Days',
            'Estimate_RentalDays' => 'Estimate  Rental Days',
            'Estimate_RentalCost' => 'Estimate  Rental Cost',
            'Repaired' => 'Repaired',
            'Complete' => 'Complete',
            'Archived' => 'Archived',
            'Deleted' => 'Deleted',
            'EstimateBy_UserID' => 'Estimate By  User ID',
            'CreatedBy_UserID' => 'Created By  User ID',
            'Created_Time' => 'Created  Time',
            'LastActionBy_UserID' => 'Last Action By  User ID',
            'LastAction_Time' => 'Last Action  Time',
        ];
    }

    public function make_slug()
    {
        $new_slug = 1;
        while ($new_slug)
        {
            // make sure our slug is unique
            $slug = strtolower(Yii::$app->getSecurity()->generateRandomString());

            $q = "SELECT ClaimID FROM Claim WHERE slug=:slug";
            $exists = Yii::$app->db->createCommand($q)->bindValues(['slug' => $slug])->queryScalar();
            if (!$exists)
                break;
        }

        return $slug;
    }

    public function beforeSave($insert)
    {
        if (!$this->slug)
        {
            $this->slug = $this->make_slug();
        }
        $this->LastAction_Time = new \yii\db\Expression('NOW()');
        return parent::beforeSave($insert);
    }

    public function search($attribs)
    {
        return Claim::find()->where($attribs)->all();
        //TODO: Check this stuff out belw, may end up being useful
        // for now we just have a search form.
        // create ActiveQuery
        $query = Claim::find();
        // Important: lets join the query with our previously mentioned relations
        // I do not make any other configuration like aliases or whatever, feel free
        // to investigate that your self
        //$query->joinWith(['city', 'country']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        /*
          // Important: here is how we set up the sorting
          // The key is the attribute name on our "TourSearch" instance
          $dataProvider->sort->attributes['city'] = [
          // The tables are the ones our relation are configured to
          // in my case they are prefixed with "tbl_"
          'asc' => ['tbl_city.name' => SORT_ASC],
          'desc' => ['tbl_city.name' => SORT_DESC],
          ];
          // Lets do the same with country now
          $dataProvider->sort->attributes['country'] = [
          'asc' => ['tbl_country.name' => SORT_ASC],
          'desc' => ['tbl_country.name' => SORT_DESC],
          ];
          // No search? Then return data Provider
          if (!($this->load($params) && $this->validate())) {
          return $dataProvider;
          }
         */
        // We have to do some search... Lets do some magic
        $query->andFilterWhere($attribs)
                // Here we search the attributes of our relations using our previously configured
                // ones in "TourSearch"
                ->andFilterWhere(['like', 'tbl_city.name', $this->city])
                ->andFilterWhere(['like', 'tbl_country.name', $this->country]);
        return $dataProvider;
    }

    public function getLocation()
    {
        return ParkingLocation::find()->where(
                        ['ParkingLocationID' => $this->ParkingLocationID]);
    }

    public function getParcoClaim()
    {
        return $this->hasOne(ParcoClaim::classname(), ['ClaimID' => 'ClaimID']);
    }

    public function getApplication()
    {
        return $this->hasOne(Application::classname(), ['ApplicationID' => 'ApplicationID']);
    }

    public function getCompany()
    {
        return $this->hasOne(Company::classname(), ['CompanyID' => 'CompanyID']);
    }

    public function getAutoMake()
    {
        return $this->hasOne(AutoMake::classname(), ['AutoMakeID' => 'AutoMakeID']);
    }

    public function getAutoModel()
    {
        return $this->hasOne(AutoModel::classname(), ['AutoModelID' => 'AutoModelID']);
    }

    public function getAuto()
    {
        $year = $this->AutoYear;
        $make = $this->autoMake;
        $model = $this->autoModel;

        $str = '';
        if ($year)
        {
            $str .= $year . ' ';
        }
        if ($make)
        {
            $str .= $make->Make . ' ';
        }
        if ($model)
        {
            $str .= $model->Model;
        }
        return $str;
    }

    public function getUser()
    {
        return $this->hasOne(User::classname(), ['UserID' => 'CreatedBy_UserID']);
    }

    public function getCreatedByUserName()
    {
        $user = $this->user;
        return sprintf('%s %s', $user->FirstName, $user->LastName);
    }

    public function getCustomerName()
    {
        $str = sprintf('%s %s', $this->Customer_FirstName, $this->Customer_LastName);
        // check if the string is empty because Yii2 will say (not set) if it is
        if (!$str)
        {
            return;
        }
        return $str;
    }

    public function getDamage()
    {
        // we have to explicitly get the CLaimID because
        // either Yii2 or PHP is to retarded to all the statement
        // $command->bindParam(':c',$this->ClaimID);
        $ClaimID = $this->ClaimID;
        $connection = Yii::$app->db;
        $sql = "SELECT * FROM ClaimDamage WHERE ClaimID=:c";
        $command = $connection->createCommand($sql);
        $command->bindParam(':c', $ClaimID);
        $res = $command->queryAll();

        foreach ($res as $r)
        {
            $return[$r['Damage']] = 1;
        }
        return $return;
    }

    public function getClaimAccounting()
    {
        return ClaimAccounting::find()->where(['ClaimID' => $this->ClaimID])->all();
    }

    public function hasAccounting()
    {
        return count($this->getClaimAccounting());
    }

    public function previousCharges()
    {
        return $this->getClaimAccounting();
    }

    public function addAccounting($amount, $details = '', $TransactionID = '')
    {
        if (isset(Yii::$app->user->identity->UserID))
        {
            $UserID = Yii::$app->user->identity->UserID;
        }
        else
        {
            $UserID = $this->CreatedBy_UserID;
        }

        $acc = new ClaimAccounting();
        $acc->CompanyID = $this->CompanyID;
        $acc->ClaimID = $this->ClaimID;
        $acc->Amount = $amount;
        $acc->Details = $details;
        $acc->TransactionID = $TransactionID;
        $acc->CreatedBy_UserID = $UserID;
        $acc->Created_Time = new \yii\db\Expression('NOW()');
        $acc->save();

        $h = new ClaimHistory;
        $h->ClaimID = $this->ClaimID;
        $h->ClaimEventID = 70;
        $h->Number = $amount;
        $h->History_Time = new \yii\db\Expression('NOW()');
        $h->UserID = $UserID;
        $h->Description = $details;
        $h->save();
    }

    public function getEstimateTypes()
    {
        $connection = Yii::$app->db;
        $sql = "
            SELECT * FROM EstimateType
            ORDER BY EstimateTypeID";
        $command = $connection->createCommand($sql);
        return $command->queryAll();
    }

    public function getNoteCompanies()
    {
        /*
         * we do it this way so there is no duplicates
         */
        $CompanyIDs = [];
        $CompanyIDs[Yii::$app->user->identity->CompanyID] = Yii::$app->user->identity->CompanyID; // CompanyID the company is part of
        $CompanyIDs[$this->CompanyID] = $this->CompanyID; // CompanyID the claim is part of
        $CompanyIDs[15] = 15; // admin company

        return Company::find()->where(['CompanyID' => $CompanyIDs])->all();
    }

    public function getNoteUsers()
    {
        return User::find()->where(['CompanyID' => $this->CompanyID, 'Active' => 1, 'Deleted' => 0])->orderBy(['FirstName' => SORT_ASC, 'LastName' => SORT_ASC])->all();
    }

    public function addDamage($damage)
    {
        // we have to explicitly get the CLaimID because
        // either Yii2 or PHP is to retarded to all the statement
        // $command->bindParam(':c',$this->ClaimID);
        $ClaimID = $this->ClaimID;
        $connection = Yii::$app->db;

        if (count($damage))
        {

            // remove all previous damage
            $sql = "DELETE FROM ClaimDamage WHERE ClaimID = :c";
            $command = $connection->createCommand($sql);
            $command->bindParam(':c', $ClaimID);
            $command->execute();
            foreach ($damage as $d)
            {

                $sql = "INSERT INTO ClaimDamage(ClaimID, Damage) VALUES(:c,:d)";
                echo $sql;
                $command = $connection->createCommand($sql);
                $command->bindParam(':c', $ClaimID);
                $command->bindParam(':d', $d);
                $command->execute();
            }
        }
        return;
    }

    public function getABRF()
    {
        return $this->hasOne(CompanyABRF::classname(), ['CompanyID' => 'ABRFID']);
    }

    public function getCounts()
    {
        $data['notes'] = $this->notesProvider()->count();
        $data['history'] = count($this->historyProvider()->models);
        $data['photos'] = count($this->getPhotos());

        return $data;
    }

    public function notesProvider()
    {
        return ClaimNote::find()->where(['ClaimID' => $this->ClaimID]);
    }

    public function filesProvider()
    {
        return ClaimFile::find()->where(['ClaimID' => $this->ClaimID]);
    }

    public function getPhotos($filetypes = [1])
    {
        return ClaimFile::find()->where(['ClaimID' => $this->ClaimID, 'ClaimFileTypeID' => $filetypes, 'Complete' => 1])->orderBy('Created_Time DESC')->all();
    }

    public function displayMedia($filetypes = [1])
    {
        $photos = $this->getPhotos($filetypes);
        if (count($photos))
        {
            $title = "Photos";
            if (count($filetypes) > 1)
                $title = "Media";
            ?>
            <h5 class='m-b-xs'><?php echo $title; ?> (<?php echo count($photos); ?>)</h5>

            <div class="lightBoxGallery" id="photos" style='margin-bottom: 10px;'>
                <?php
                $dt1 = 10000000000000;
                foreach ($photos as $photo)
                {
                    $last = $dt1;
                    $dt1 = strtotime($photo->Created_Time);
                    $diff = $last - $dt1;
                    
                    if ($diff > 60 * 20)
                    {
                        echo "<h5 class='m-b-xs'>";
                        echo "Uploaded on ";
                        echo Yii::$app->formatter->asDatetime($photo->Created_Time);
                        echo " by ";
                        echo $photo->user->FirstName . ' ' . $photo->user->LastName;
                        echo "</h5>";
                    }
                    
                    if ($photo->ClaimFileTypeID == 8)
                    {
                        ?>
                        <a href="<?php echo $photo->getEncryptedFilename(); ?>" class="colorbox-claim-video claimVideo"><img src="<?php echo $photo->getEncryptedFilename('thumb'); ?>" /></a>
                        <?php
                    }
                    else if ($photo->ClaimFileTypeID == 1)
                    {
                        echo '<span class="claimPhotoWrapper">';
                        ?>
                        <a href="<?php echo $photo->getEncryptedFilename(); ?>" class="colorbox-claim-photos claimPhotos">
                            <img class="claim-thumb-<?= $photo->ClaimFileID; ?>" src="<?php echo $photo->getEncryptedFilename('thumb'); ?>"/>
                        </a>
                        <?php
if (Yii::$app->user->identity->UserLevelID > 99)
{
?>
                            <div class="claim-photo">
                                <a href="<?php echo '/claim/' . $this->slug . '/claimfiledelete?id=' . $photo->ClaimFileID; ?>" class="swal_general claimfiledelete" >
                                    <i class="fa fa-remove" title="Delete"></i>
                                </a>
                                <i class="rotate-claim-photo fa fa-repeat" data-id="<?= $photo->ClaimFileID; ?>" title="Rotate 90 deg"></i>
                            </div>
<?php
}
echo '</span>';
                    }
                }
                ?>
            </div>
            <?php
        }
    }

    public function getEstimateFiles($approved = [0, 1])
    {
        return ClaimFile::find()->where(['ClaimID' => $this->ClaimID, 'ClaimFileTypeID' => [2, 5], 'Approved' => $approved])->orderBy('Approved DESC, Created_Time DESC')->all();
    }

    public function getAutoWageLocation()
    {
        if ($this->ParkingLocationID)
        {
            return AutoWageLocation::find()->where(['ParkingLocationID' => $this->ParkingLocationID])->one();
        }
        return null;
    }

    static public function getClaimArrayBySlug($slug)
    {
        $connection = Yii::$app->db;
        $sql = "SELECT
	            C.*,
	            A.Application,
	            C.AutoRental,
	            C.Estimate_Dollars,
	            Comp.Company,
	            ABRF.CompanyID AS ABRFID,
	            ABRF.Company AS ABRF,
	            CE.Event,
	            AM.Make,
	            AMod.Model,
	            C.AutoYear,
	            C.Customer_FirstName,
	            C.Customer_LastName,
	            CB.UserID,
	            CB.FirstName,
	            CB.LastName,
	            CB_Comp.Company AS CB_Company,
	            C.Created_Time,
	            C.LastAction_Time,
	            CP.*,
	            PL.*,
	            Lot.LotNumber,
	            CONCAT(C.Customer_FirstName,' ',C.Customer_LastName) AS CustomerName,
	            CONCAT(C.AutoYear,' ',AM.Make,' ',AMod.Model) AS Auto,
	            CONCAT(CB.FirstName,' ',CB.LastName) AS CreatedBy
            FROM
	            Claim C
            LEFT OUTER JOIN
	            ClaimParco CP
            ON
	            CP.ClaimID = C.ClaimID
            LEFT JOIN
	            Application A
            ON
	            A.ApplicationID = C.ApplicationID
            LEFT OUTER JOIN
	            Company Comp
            ON
	            Comp.CompanyID = C.CompanyID
            LEFT OUTER JOIN
	            Company ABRF
            ON
	            ABRF.CompanyID = C.ABRFID
            LEFT OUTER JOIN
	            ClaimEvent CE
            ON
	            CE.ClaimEventID = C.ClaimEventID
            LEFT OUTER JOIN
	            AutoMake AM
            ON
	            AM.AutoMakeID = C.AutoMakeID
            LEFT OUTER JOIN
	            AutoModel AMod
            ON
	            AMod.AutoModelID = C.AutoModelID
            LEFT OUTER JOIN
	            User CB
            ON
	            CB.UserID = C.CreatedBy_UserID
            LEFT OUTER JOIN
	            Company CB_Comp
            ON 
	            CB_Comp.CompanyID = CB.CompanyID
	    LEFT OUTER JOIN
                ParkingLocationLot Lot
	    ON 
                Lot.ParkingLocationLotID = CP.Parco_ParkingLocationLotID
	    LEFT OUTER JOIN 
                ParkingLocation PL
	    ON
                PL.ParkingLocationID = Lot.ParkingLocationID
            WHERE
	             C.slug = :slug
	        ";

        $command = $connection->createCommand($sql);
        $command->bindParam(':slug', $slug);
        return $command->queryOne();
    }

    public function historyProvider()
    {
        //$GLOBALS['gclaim'] = $this;
        $sql = "
            SELECT 
                U.FirstName,
                U.LastName,
                U.Phone,
                U.Email,
                U.CompanyID,
                Co.Company,
                CH.*,
                CE.Event,
                CE.ClaimEventID
            FROM 
                ClaimEvent CE
            JOIN 
                ClaimHistory CH
            ON 
                CH.ClaimEventID = CE.ClaimEventID
            JOIN 
                Claim C 
            ON 
                C.ClaimID = CH.ClaimID
            LEFT OUTER JOIN 
                User U
            ON
                U.UserID = CH.UserID 
            LEFT OUTER JOIN
                Company Co
            ON
            Co.CompanyID = U.CompanyID 
            WHERE
                C.ClaimID = :ClaimID AND
                CE.Show = 1
            ORDER BY 
                History_Time DESC";

        $provider = new SqlDataProvider([
            'sql' => $sql,
            'params' => [':ClaimID' => $this->ClaimID],
        ]);

        return $provider;
    }

    public function opMgrsAtLocationProvider()
    {
        $sql = "
            SELECT U.* FROM User U
            JOIN UserParkingLocation UL ON UL.UserID = 
            U.UserID WHERE UL.ParkingLocationID = :PLID
            AND U.UserLevelID=5";

        $provider = new SqlDataProvider([
            'sql' => $sql,
            'params' => [':PLID' => $this->ParkingLocationID],
        ]);

        return $provider;
    }

    public function StatusChange($ClaimEventID, $Num, $Description, $user_id = 0)
    {
        if ($user_id == 0)
        {
            $user_id = Yii::$app->user->identity->UserID;
        }
        $this->ClaimEventID = $ClaimEventID;
        $this->LastActionBy_UserID = $user_id;
        $this->LastAction_Time = new \yii\db\Expression('NOW()');
        $this->save();
        
        $this->Event($ClaimEventID, $Num, $Description, $user_id);
    }

    public function Event($ClaimEventID, $Num, $Description='', $user_id=NULL)
    {
        if ($user_id === NULL)
        {
            $user_id = Yii::$app->user->identity->UserID;
        }
        $sql = "INSERT INTO
			ClaimHistory
		SET
			ClaimID = " . $this->ClaimID . ",
			ClaimEventID = " . $ClaimEventID . ",
			UserID = '" . $user_id . "',
			Number = '" . $Num . "',
			Description = '" . $Description . "',
			History_Time = CURRENT_TIMESTAMP()";
        $command = Yii::$app->db->createCommand($sql);
        $command->execute();

        $this->updateLastActionTime();

        return;
    }

    public function EventDisplay($v)
    {
        switch ($v["Event"])
        {
            case "ABRF Initiated Claim":
                $msg = "Claim process initiated.";
                break;
            case "Claim has been submitted":
                $msg = "Claim has been sent.";
                break;
            case "Ready for Review":
                $msg = "Additional items sent for review.";
                break;
            case "OASIS: Requested Additional Photos":
                $msg = "Additional photos requested.";
                break;
            case "OASIS: Authorized for Teardown":
                $msg = "Authorized Vehicle for Teardown.";
                break;
            case "OASIS: Rekey and Notify":
                $msg = "Requested a rekey at $" . number_format($v["Number"], 2) . ".";
                break;
            case "OASIS: Authorization for Repair and Payment":
                $msg = "Approved Estimate for Repair.";
                break;
            case "OASIS: Field Adjuster Dispatched":
                $msg = "Dispatched Re-Inspector.";
                break;
            case "ABRF Repairing Vehicle":
                $msg = "Vehicle Repair in Progress.";
                break;
            case "Complete":
                $msg = "Processing on this claim is complete.";
                break;
            case "Archived":
                $msg = "This claim has been archived.";
                break;
            case "PARCO: Claim Inputted":
                $msg = "Claim process intiated.";
                break;
            case "PARCO: Adjuster's Estimate Complete":
                $msg = "Adjuster uploaded estimate.";
                break;
            case "PARCO: New Claim":
                $msg = "Claim ready for management review.";
                break;
            case "Photos Uploaded":
                $msg = number_format($v["Number"], 0) . " photo(s) uploaded to claim.";
                break;
            case "PARCO: Denied Claim":
                $msg = "This claim has been denied.";
                break;
            case "PARCO: Awaiting Estimate":
                $msg = "Claim has been sent for an estimate.";
                break;
            case "Communication Sent to User":
                $msg = "Processing letter has been sent to claimant.";
                break;
            case "PARCO: Claim Not Complete":
                $msg = "Claim process initiated.";
                break;
            case "PARCO: Awaiting Claimant Response":
                $msg .= $this->showViewLink($v['Number']);
                $msg .= "A settlement offer has been sent to the claimant.";
                break;
            case "PARCO: Claimant Accepted Settlement":
                $msg = "The claimant has accepted the settlement offer.";
                break;
            case "PARCO: Claimant Refused Settlement":
                $msg = "The claimant has refused the settlement offer.";
                break;
            case "Communication has been sent.":
                $msg = "" . $v["Description"] . " was email information on this claim.";
                break;
            case "OASIS: Rekey Denied":
                $msg = "Rekey has been denied.";
                break;
            case "OASIS: Rekey Accepted":
                $msg = "Rekey has been accepted.";
                break;
            case "PARCO: Awaiting Subrogation":
                $msg = "Awaiting Subrogation.";
                break;
            case "PARCO: Introduction Call to Claimant Successful - Contact Info Verified":
                $msg = "Introduction call placed and contact information verified.";
                break;
            case "PARCO: Introduction Call, unable to contact":
                $msg = "Introduction call attempt, unable to contact.";
                break;
            case "PARCO: Ops Mgr Suggests Process":
                $msg = "Ops Mgr recommends this claim should be processed.";
                break;
            case "PARCO: Ops Mgr Suggests Denial":
                $msg = "Ops Mgr recommends this claim should be denied.";
                break;
            case "PARCO: Check Mailed to Claimant":
                $msg = "Check mailed to Claimant on " . $v["Description"] . ".";
                break;
            case "Claim Status Modified":
                $msg = "Claim Status Modified to '" . $v["Description"] . "'.";
                break;
            case "IE: Customer Info":
                $msg = "Customer info entered.";
                break;
            case "IE: Claim Initiated":
                $msg = "Claim process initiated.";
                break;
            case "IE: Auto Selected":
                $msg = "Vehicle has been selected.";
                break;
            case "IE: Customer Edited Claim":
                $msg = "Claim has been edited.";
                break;
            case "IE: Customer Requests Contact":
                $msg = "Customer requests Body Shop contact.";
                break;
            case "IE: Estimate Complete":
                $msg = "Instant Estimate complete.";
                break;
            case "IE: Claim Assigned to Customer":
                $msg = "Claim Assigned to Customer.";
                break;
            case "IE: Customer Not Interested":
                $msg = "Customer not interested in a repair.";
                break;
            case "IE: Vehicle Repair Authorized":
                $msg = "Vehicle Repair Authorized.";
                break;
            case "IE: Customer Asked to Verify Contact Info":
                $msg = "Customer Asked to Verify Contact Information.";
                break;
            case "IE: Company Purchased Claim":
                $msg = "Claim purchased.";
                break;
            case "IE: Instant Estimator assigned Claim":
                $msg = "Claim assigned.";
                break;
            case "	IE: Photos Uploaded, Awaiting Contact":
                $msg = "Claimant uploaded photos.";
                break;
            case "RC: Ready for Review":
                $msg = "Claim ready for review.";
                break;
            case "RC: Awaiting Acceptance":
                $msg = "Awaiting body shop acceptance.";
                break;
            case "Location Changed":
                $msg = "Location of this claim has been changed";
                break;
            case "Communication has been sent to claimant.":
                $msg .= "Message has been sent to claimant";
                if (strlen($v["Description"]))
                {
                    $msg .= " (" . $v["Description"] . ")";
                }
                $msg .= ".";
                break;
            case "RC: Out for Repair":
                $msg = "Vehicle out for repair.";
                break;
            case "RC: Job has been accepted":
                $msg = "Job has been accepted.";
                break;
            case "RC: Repair Complete":
                $msg = "Body Shop has completed repairs.";
                break;
            case "RC: Customer payment complete.":
                $msg = "Customer payment complete.";
                break;
            case "Claim Costs have been updated":
                $msg = "Claim Costs have been updated.";
                break;
            case "Claim Created via Mobile App":
                $msg = "Cleam created via mobile application.";
                break;
            case "RC: Job request sent to body shop":
                $sql = "SELECT
	                Company
                FROM
	                Company
                WHERE
	                CompanyID = " . $v['Number'];
                $connection = Yii::$app->db;
                $command = $connection->createCommand($sql);
                $r = $command->queryOne();
                $msg = "" . $r['Company'] . " has been sent an Accept/Deny request.";
                break;
            case "Document Added to Claim":
                $cf = ClaimFile::findOne($v['Number']);
                if (isset($cf))
                {
                //$msg = ' <a href="../pdf/"><span class="label label-primary">Download: ' . $v["Description"] . ' <i class="fa fa-download"></i></span></a>';
                $msg = '<a class="btn btn-sm btn-success pull-right colorbox-claim-file" href="' . $cf->getEncryptedFilename() . '">' . $v['Description'] . ' <i class="fa fa-download"></i></a>';
                $msg .= "Document Uploaded - " . $cf->claimfiletype->ClaimFileType;
                }
                break;
            case "Check Request Sent to Accounting":
                $msg .= $this->showViewLink($v['Number']);
                $msg .= "Request sent to Accounts Payable.";
                break;
            case "Claimant Verified Contact Information":
                $msg = "Claimant Verified Contact Information via Portal";
                break;
            case "Claimant Information Verified with No Changes":
                $msg = "Claimant Information Verified with No Changes via Portal";
                break;
            case "Added to Subrogation":
                $msg = "Added to Subrogation";
                break;
            case "Removed from Subrogation":
                $msg = "Removed from Subrogation";
                break;
            case "Follow Up Requested":
                $msg = "Requested follow up";
                break;
            case "Follow Up Request Completed":
                $msg = "Follow Up Request Completed";
                break;
            case "VendorID Created":
                $msg = "Vendor ID Created";
                if (strlen($v["Description"]))
                {
                    $msg .= " (" . $v["Description"] . ")";
                }
                break;
            default:
                $msg = "" . $v["ClaimEventID"] . " - We cannot decipher what this is?";
                break;
        }
        return $msg;
    }

    public function showViewLink($number)
    {
        if ($number == 0)
            return;
        return HTML::a('View Communication <i class="fa fa-file"></i>', ['claim/' . $this->slug . '/communicationview', 'MessageHistoryID' => $number], ['class' => 'btn btn-sm btn-info pull-right colorbox-ajax', 'title' => $v["Description"] . ' Message']);
    }

    public function makeUserfilePath()
    {

        $ClaimID = $this->ClaimID;
        $this->basePath = $_SERVER['DOCUMENT_ROOT'] . Yii::$app->params['files']['pathTo'];

        $folder = floor($ClaimID / 10000);
        $folder = $folder * 10000;
        $f = $folder . "/";

        @mkdir($this->basePath . $f, 0777);
        @chmod($this->basePath . $f, 0777);

        @mkdir($this->basePath . "t/" . $f, 0777);
        @chmod($this->basePath . "t/" . $f, 0777);

        // Second Folder
        $folder = floor($ClaimID / 1000);
        $folder = $folder * 1000;
        $f .= $folder . "/";

        @mkdir($this->basePath . $f, 0777);
        @chmod($this->basePath . $f, 0777);

        @mkdir($this->basePath . "t/" . $f, 0777);
        @chmod($this->basePath . "t/" . $f, 0777);

        // claim id
        $f .= $ClaimID . "/";

        // Create Photo Folder
        @mkdir($this->basePath . $f, 0777);
        @chmod($this->basePath . $f, 0777);

        @mkdir($this->basePath . "t/" . $f, 0777);
        @chmod($this->basePath . "t/" . $f, 0777);

        $this->mainPath = $f;
        $this->thumbnailPath = $f;
    }

    /*
     * check if the user is authorized to see this Claim #
     */

    public function isUserAuthorized()
    {
        //$actionAlwaysAllowed = ['claim/incidenttype', 'claim/claimantinfo'];
        $actionAlwaysAllowed = [];
        if (Yii::$app->user->identity->UserLevelID > 99)
            return true;

        /*
         * STEP 1: check if Claim belongs to users company
         * STEP 2: check if MultiCompany user and this claim belongs to one of their other companies
         * STEP 3: actionAlwaysAllowed is an override
         */
        if ($this->CompanyID == Yii::$app->user->identity->activeCompany->CompanyID ||
                in_array($this->CompanyID, explode(',', Yii::$app->user->identity->MultiCompany)) ||
                in_array(Yii::$app->requestedRoute, $actionAlwaysAllowed))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /*
     * does this location have operations managers
     */

    public function hasOperationManagers($pll)
    {
        $q = "SELECT
		U.UserID,
		U.FirstName,
		U.LastName,
		U.Phone,
		U.Email,
        CH.ClaimEventID
	FROM
		ParkingLocationLot PLL
	LEFT JOIN
		ParkingLocation PL
	ON
		PL.ParkingLocationID = PLL.ParkingLocationID
	LEFT JOIN
		UserParkingLocation UPL
	ON
		UPL.ParkingLocationID = PL.ParkingLocationID
	LEFT JOIN
		User U
	ON
		U.UserID = UPL.UserID
    LEFT OUTER JOIN
    	ClaimHistory CH
    ON 
    	(CH.ClaimID = :ClaimID AND
         CH.ClaimEventID IN (31,32) AND
         CH.UserID = U.UserID)
	WHERE
		PLL.ParkingLocationLotID = :ParkingLocationLotID AND
		U.Active = 1 AND
		U.Deleted = 0";
        $query = Yii::$app->db->createCommand($q)->bindValues([':ClaimID' => $this->ClaimID, ':ParkingLocationLotID' => $pll])->queryAll();

        return $query;
    }

    public function updateLastActionTime()
    {
        $this->LastAction_Time = new \yii\db\Expression('NOW()');
        $this->save();
    }

    public function getClaimDirectorEmails()
    {
        $company = Company::findOne($this->CompanyID);
        $cd = $company->ClaimsDirector_Email;
        $cd = preg_replace('/\s+/', '', $cd); // remove spaces
        if (strlen($cd))
        {
            if (strstr($cd, ','))
            {
                $emails = explode(',', $cd);
            }
            else
            {
                $emails[] = $cd;
            }
        }
        else
        {
            $emails = [];
        }
        return $emails;
    }

    public function getOperationManagerEmails($parkingLocationLotID)
    {
        // check for ops mgr
        $q = "SELECT
			U.UserID,
			U.Email
		FROM
			UserParkingLocation UPL
		LEFT JOIN
			ParkingLocationLot PLL
		ON
			PLL.ParkingLocationLotID = :ParkingLocationLotID
		LEFT JOIN
			User U
		ON
			U.UserID = UPL.UserID
		WHERE
			UPL.ParkingLocationID = PLL.ParkingLocationID";
        $ops = Yii::$app->db->createCommand($q)->bindValues([':ParkingLocationLotID' => $parkingLocationLotID])->queryAll();
        for ($i = 0; $i < count($ops); $i++)
        {
            $emails[] = $ops[$i]['Email'];
        }
        return $emails;
    }

    public function getDisplayAddress()
    {
        $label = $this->Customer_Address;
        if (strlen($this->Customer_Address2))
        {
            $label .= '<br />' . $this->Customer_Address2;
        }
        $label .= '<br />' . $this->Customer_City . ', ' . $this->Customer_State . ' ' . $this->Customer_Zip;
        return $label;
    }

}
