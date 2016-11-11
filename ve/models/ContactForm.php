<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $company;
    public $body;
    public $interest;
    public $interestOptions = ['Area of Interest', 'Claim Solutions', 'Business Intelligence and Analytics', 'Mobile Capabilities', 'Arranging Demonstration', 'Other'];
    
    public $title;
    public $titleOptions = ['Title', 'Executive', 'Operations', 'Procurement', 'Marketing', 'Other'];
    
    public $verifyCode;
    
    public $subject = 'Loss Capture Web Site Contact Form';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email'], 'required'],
            [['phone', 'company', 'body', 'interest', 'title'], 'string'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'interest' => 'Area of Interest',
            'title' => 'Title',
            'company' => 'Company',
            'body' => 'Your Message',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        
        $message = " 
Name: {$this->name} 
Email: {$this->email} 
Phone: {$this->phone} 
Company: {$this->company} 
Title: {$this->titleOptions[$this->title]} 
Area of Interest: {$this->interestOptions[$this->interest]} 
Body: 
{$this->body}
";
        
        $email = ['slandis@claimsolutionsgroupinc.com', 'cschulz@claimsolutionsgroupinc.com'];
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($message)
                ->send();

            return true;
        } else {
            return false;
        }
    }
}
