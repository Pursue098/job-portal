<?php
/**
 * Created by Azam Ali.
 * User: usol
 * Date: 12/7/16
 * Time: 12:30 PM
 */

namespace App;
namespace App\Helper;


class FillableDropdown
{
    public function eventOperations($default = null){

        if($default == 1){
            return [''=>'Select operation', 0=>'Subscribe',1=>'Un subscribe', 2=>'Going',3=>'Not Going', 4=>'Interested',5=>'Not interested'];

        }elseif($default == 2){
            return [0=>'Subscribe',1=>'Un subscribe', 2=>'Going',3=>'Not Going', 4=>'Interested',5=>'Not interested'];

        }
    }

    public function gender($default = null){

        if($default == 1){
            return [''=>'Select gender', 0=>'doesn\'t matter',1=>'Male', '2'=>'Female'];

        }elseif($default == 2){
            return [0=>'Doesn\'t matter',1=>'Male', '2'=>'Female'];

        }
    }

    public function travel($default = null){

        if($default == 1){
            return [''=>'Select gender', 0=>'Yes',1=>'No'];

        }elseif($default == 2){
            return [0=>'Yes',1=>'No'];

        }
    }

    public function accessibility($default = null){

        if($default == 1){
            return [''=>'Select accessibility', 0=>'Public',1=>'Private'];

        }elseif($default == 2){
            return [0=>'Public',1=>'Private'];

        }
    }

    public function experience($default = null){

        if($default == 1){
            return [''=>'Select experience', 0=>'Fresh', 1=>'Internship', 2=>'1 Year', 3=>'2 Years',
                4=>'3 Years', 5=>'4 Years', 6=>'5 Years', 7=>'6 Years', 8=>'7 Years', 9=>'8 Years',
                10=>'9 Years', 11=>'10 Years', 12=>'11 Years', 13=>'12 Years', 14=>'13 Years', 15=>'14 Years',
                16=>'15 Years', 17=>'16 Years', 18=>'17 Years', 19=>'18 Years', 20=>'19 Years', 21=>'20 Years',
                22=>'21 Years', 23=>'22 Years', 24=>'23 Years', 25=>'24 Years', 26=>'25 Years', 27=>'26 Years',
                28=>'27 Years', 29=>'28 Years', 30=>'29 Years', 31=>'30 Years', 32=>'31 Years', 33=>'32 Years',
                34=>'33 Years', 35=>'34 Years', 36=>'35 Years', 37=>'More then 35 years'];

        }elseif($default == 2){
            return [0=>'Fresh', 1=>'Internship', 2=>'1 Year', 3=>'2 Years',
                4=>'3 Years', 5=>'4 Years', 6=>'5 Years', 7=>'6 Years', 8=>'7 Years', 9=>'8 Years',
                10=>'9 Years', 11=>'10 Years', 12=>'11 Years', 13=>'12 Years', 14=>'13 Years', 15=>'14 Years',
                16=>'15 Years', 17=>'16 Years', 18=>'17 Years', 19=>'18 Years', 20=>'19 Years', 21=>'20 Years',
                22=>'21 Years', 23=>'22 Years', 24=>'23 Years', 25=>'24 Years', 26=>'25 Years', 27=>'26 Years',
                28=>'27 Years', 29=>'28 Years', 30=>'29 Years', 31=>'30 Years', 32=>'31 Years', 33=>'32 Years',
                34=>'33 Years', 35=>'34 Years', 36=>'35 Years', 37=>'More then 35 years'];

        }
    }

    public function vacancy($default = null){

        if($default == 1){
            return [''=>'Select vacancy', 0=>1, 1=>2, 2=>3, 3=>4, 4=>5, 5=>6, 6=>7, 7=>8];

        }elseif($default == 2){
            return [0=>1, 1=>2, 2=>3, 3=>4, 4=>5, 5=>6, 6=>7, 7=>8];

        }
    }


    public function active($default = null){

        if($default == 1){
            return [''=>'Select status mode', 0=>'No', 1=>'Yes',];

        }elseif($default == 2){
            return [0=>'No',1=>'Yes',];

        }
    }
    public function statusByKeyValue($default = null){

        if($default == 1){

            $data[0]['key']="";
            $data[0]['value']="please perform operation";
            $data[1]['key']="1";
            $data[1]['value']="Un view";
            $data[2]['key']="2";
            $data[2]['value']="Short list";
            $data[3]['key']="3";
            $data[3]['value']="Rejected";
            $data[4]['key']="4";
            $data[4]['value']="Hired";
            return $data;

        }elseif ($default == 2){

            $data[0]['key']="1";
            $data[0]['value']="Un view";
            $data[1]['key']="2";
            $data[1]['value']="Short list";
            $data[2]['key']="3";
            $data[2]['value']="Rejected";
            $data[3]['key']="4";
            $data[3]['value']="Hired";
            return $data;

        }
    }
}