<?php
Class Tickets{


    public function get_department($did){

        $dname = '';

        $d = ORM::for_table('sys_ticketdepartments')->find_one($did);

        if($d){
            $dname = $d->dname;
        }

        return $dname;


    }

    public static function sendReplyNotification($tid,$message){

        $d = ORM::for_table('sys_tickets')->find_one($tid);

        if($d){

            if($d->email == ''){
                return false;
            }

            Ib_Email::_send($d->account,$d->email,'[TID '.$d->tid.']'.$d->subject,$message,$d->userid,$d->aid,$d->cc,$d->bcc);
        }

        return false;

    }


    public function create($cid=0,$admin=0,$flag=0,$source='Web'){
        global $config;
        $msg = '';


        $ib_now = date('Y-m-d H:i:s');

        $tid = strtoupper(Ib_Str::random_alpha(3)).'-'._raid(8);


        $did = _post('department');



        $dname = $this->get_department($did);

        $account = '';
        $email = '';
        $last_reply = '';



        if($cid != 0){
            $d = ORM::for_table('crm_accounts')->find_one($cid);

            if($d){
                $account = $d->account;
                $email = $d->email;
                $last_reply = $d->account;
            }
        }

        else{
            // create lead

            $account = _post('account');

            $first_name = '';
            $middle_name = '';
            $last_name = '';


            $email = _post('email');
            $last_reply = $account;
            if($account == ''){
//                $msg .= 'Full Name is required. <br>';
//                return array(
//                    "success" => "No",
//                    "msg" => $msg
//                );


                $account = Ib_Str::randomName();


            }

            $account_e = explode(' ',$account);

            if(isset($account_e[0])){
                $first_name = $account_e[0];

            }

            if(isset($account_e[1])){
                $last_name = $account_e[1];
            }

            if(isset($account_e[3])){
                $middle_name = $last_name;
                $last_name = $account_e[3];
            }

            if($last_name == ''){
                $last_name = $first_name;
            }


//            if($email == ''){
//                $msg .= 'Email is required. <br>';
//                return array(
//                    "success" => "No",
//                    "msg" => $msg
//                );
//            }

            $e_user = ORM::for_table('crm_accounts')->where('email',$email)->find_one();

            if($e_user && $email != ''){
                $cid = $e_user->id;
            }
            else{
//                if($account == ''){
//                    $msg .= 'Full Name is required. <br>';
//                }
//                if($email == ''){
//                    $msg .= 'Email is required. <br>';
//                }

//                $c_add['account'] = $account;
//                $c_add['email'] = $email;

                $l_add['first_name'] = $first_name;
                $l_add['last_name'] = $last_name;
                $l_add['middle_name'] = $middle_name;
                $l_add['email'] = _post('email');
                $l_add['phone'] = _post('phone');




//                if($msg == ''){
//                    $cid = Contacts::add($c_add,true,true);
//                    if(!is_numeric($cid)){
//                        return array(
//                            "success" => "No",
//                            "msg" => $cid
//                        );
//                    }
//                }
//                else{
//                    return array(
//                        "success" => "No",
//                        "msg" => $msg
//                    );
//                }




            }

        }

        $message = ib_post('message');
        $subject = ib_post('subject');



        if($subject == ''){
            $msg .= 'Subject is required. <br>';
        }

        if($message == ''){
            $msg .= 'Message is required. <br>';
        }



        $urgency = _post('urgency');


        if($msg == ''){



            $d = ORM::for_table('sys_tickets')->create();
            $d->tid = $tid;
            $d->did = $did;
            $d->dname = $dname;
            $d->userid = $cid;
            $d->account = $account;
            $d->email = $email;
            $d->created_at = $ib_now;
            $d->updated_at = $ib_now;
            $d->subject = $subject;
            $d->message = $message;
            $d->status = 'Open';
            $d->urgency = $urgency;
            $d->admin = $admin;
            $d->attachments = ib_post('attachments');
            $d->last_reply = $last_reply;
            $d->flag = $flag;
            $d->is_spam = 0;
            $d->client_read = 'No';
            $d->admin_read = 'No';
            $d->source = $source;
            $d->ttype = _post('ttype'); //  Question Incident Problem Feature Request
            $d->tstart = '';
            $d->tend = '';
            $d->ttotal = '';
            $d->todo = '';
            $d->tags = '';
            $d->notes = '';
            $d->save();



            $ret_val = array(

                "success" => "Yes",
                "msg" => "Ticket Created Successfully",
                "account" => $account,
                "email" => $email,
                "subject" => $subject,
                "body" => $message,
                "id" => $d->id(),
                "tid" => $tid

            );

            // Send Email to Client


//            $eml = ORM::for_table('sys_email_templates')->where('tplname','Tickets:Client Ticket Created')->where('send','Yes')->find_one();
//            if($eml){
//
//
//
//                $eml_subject = new Template($eml->subject);
//                $eml_subject->set('business_name', $config['CompanyName']);
//                $eml_subject->set('subject', $subject);
//                $eml_subject->set('ticket_subject', $subject);
//                $subj = $eml_subject->output();
//
//                $eml_message = new Template($eml->message);
//                $eml_message->set('client_name', $account);
//                $eml_message->set('client_email', $email);
//                $eml_message->set('priority', $urgency);
//                $eml_message->set('urgency', $urgency);
//                $eml_message->set('ticket_urgency', $urgency);
//                $eml_message->set('ticket_priority', $urgency);
//                $eml_message->set('ticket_id', '#'.$tid);
//                $eml_message->set('message', $message);
//                $eml_message->set('business_name', $config['CompanyName']);
//                $message_o = $eml_message->output();
//
//                $mail = Notify_Email::_init();
//                $mail->AddAddress($email, $account);
//                $mail->Subject = $subj;
//                $mail->MsgHTML($message_o);
//
//                if(APP_STAGE == 'Live'){
//                    $mail->Send();
//                }
//
//
//            }

            $eml = ORM::for_table('sys_email_templates')->where('tplname','Tickets:Client Ticket Created')->where('send','Yes')->find_one();
            if($eml && Validator::Email($email)){



                $client_view_link = U.'client/tickets/view/'.$d->tid.'/';

                $eml_subject = new Template($eml->subject);
                $eml_subject->set('business_name', $config['CompanyName']);
                $eml_subject->set('subject', $subject);
                $eml_subject->set('ticket_subject', $subject);
                $subj = $eml_subject->output();

                $eml_message = new Template($eml->message);
                $eml_message->set('client_name', $account);
                $eml_message->set('client_email', $email);
                $eml_message->set('priority', $urgency);
                $eml_message->set('urgency', $urgency);
                $eml_message->set('subject', $subject);
                $eml_message->set('subject', $subject);
                $eml_message->set('ticket_subject', $subject);
                $eml_message->set('status', $urgency);
                $eml_message->set('ticket_status', $d->status);
                $eml_message->set('ticket_urgency', $urgency);
                $eml_message->set('ticket_priority', $urgency);
                $eml_message->set('ticket_id', '#'.$tid);
                $eml_message->set('message', $message);
                $eml_message->set('business_name', $config['CompanyName']);
                $eml_message->set('ticket_link',$client_view_link);
                $message_o = $eml_message->output();

                Notify_Email::_send($account, $email, $subj, $message_o, $cid);

            }


            $eml = ORM::for_table('sys_email_templates')->where('tplname','Tickets:Admin Ticket Created')->where('send','Yes')->find_one();

            if($eml && Validator::Email($email)){

                $admin_view_link = U.'tickets/admin/view/'.$d->id;

                $eml_subject = new Template($eml->subject);
                $eml_subject->set('business_name', $config['CompanyName']);
                $eml_subject->set('subject', $subject);
                $eml_subject->set('ticket_subject', $subject);
                $subj = $eml_subject->output();

                $eml_message = new Template($eml->message);
                $eml_message->set('client_name', $account);
                $eml_message->set('client_email', $email);
                $eml_message->set('priority', $urgency);
                $eml_message->set('urgency', $urgency);
                $eml_message->set('status', $urgency);
                $eml_message->set('ticket_status', $d->status);
                $eml_message->set('ticket_urgency', $urgency);
                $eml_message->set('ticket_priority', $urgency);
                $eml_message->set('ticket_id', '#'.$tid);
                $eml_message->set('message', $message);
                $eml_message->set('business_name', $config['CompanyName']);
                $eml_message->set('admin_view_link',$admin_view_link);
                $message_o = $eml_message->output();

               // $mail = Notify_Email::_init();

                // find all admin

                $admins = ORM::for_table('sys_users')->find_array();
                foreach ($admins as $admin){
                    Notify_Email::_send($admin['fullname'], $admin['username'], $subj, $message_o, $cid);
                }



            }





            //

            Event::trigger('tickets/created/',$ret_val);

        }
        else{

            $ret_val = array(

                "success" => "No",
                "msg" => $msg


            );
        }


        return $ret_val;



    }

    public static function gen_link_attachments($attachments){

        $html = '';

        $a = explode(',',$attachments);

        foreach ($a as $l){

            $html .= '<img src="'.APP_URL.'/storage/tickets/'.$l.'" class="img-thumbnail" alt="Cinque Terre" width="300"> ';

        }

        return $html;

    }


    public function add_reply($admin=0,$sendEmail=true)
    {

        global $config;
        $msg = '';

        $ib_now = date('Y-m-d H:i:s');

        $tid = _post('f_tid');

        $ret_val = array(

            "success" => "No"


        );


        $account = '';
        $email = '';
        $last_reply = '';

        $reply_type = _post('reply_type','Public');




        if($admin != 0){
            $adm = ORM::for_table('sys_users')->find_one($admin);
            if($adm){
                $last_reply = $adm->fullname;
            }
        }

        $message = ib_post('message');

        if ($message == '') {
            $msg .= 'Message is required. <br>';
        }

        $t = ORM::for_table('sys_tickets')->find_one($tid);

        if ($t) {
            $t->updated_at = $ib_now;
            $t->replied_by =
                $t->save();
            $cid = $t->userid;
        }
        else{
            $cid = 0;
        }



        if ($msg == '') {

            if ($admin == 0) {
                $replied_by = $account;
            } else {
                $adm = ORM::for_table('sys_users')->find_one($admin);
                if ($adm) {
                    $replied_by = $adm->fullname;
                }
            }


            $d = ORM::for_table('sys_ticketreplies')->create();
            $d->tid = $tid;
            $d->userid = $cid;
            $d->account = $account;
            $d->reply_type = $reply_type;
            $d->email = '';
            $d->created_at = $ib_now;
            $d->updated_at = $ib_now;
            $d->message = $message;
            $d->replied_by = $last_reply;
            $d->admin = $admin;
            $d->attachments = ib_post('attachments');
            $d->client_read = '';
            $d->admin_read = '';
            $d->save();

            $ret_val = array(

                "success" => "Yes",
                "msg" => "Ticket Updated Successfully",
                "id" => $d->id(),
                "tid" => $tid

            );

            if ($sendEmail) {

                Ib_Email::_send($account,$email,'['.$t->tid.'] '.$t->subject,$message,$cid,'0',$t->cc,$t->bcc);



                $dep =  ORM::for_table('sys_ticketdepartments')->find_one($t->did);

                $from = array();
                if($dep){
                    $from = array($dep['email'] => $dep['dname']);
                }




//                Mailer::send(array($t->email => $t->account),'[TID '.$t->tid.'] '.$t->subject,$message,'Ticket',$d->id());

            }

        } else {
            $ret_val = array(

                "success" => "No",
                "msg" => $msg


            );
        }




        return $ret_val;

    }



    public static function addPredefinedReply($data=array()){

        $msg = '';


        $id = '';

        $success = 'No';

        if(!isset($data['title']) || $data['title'] == ''){

            $msg .= 'Title is required. <br>';

        }

        if(!isset($data['message']) || $data['message'] == ''){

            $msg .= 'Message is required. <br>';

        }

        if($msg == ''){

            $d = ORM::for_table('sys_canned_responses')->create();

            $d->title = $data['title'];
            $d->message = $data['message'];
            $d->save();

            $success = 'Yes';

            $id = $d->id();

            $msg = 'Added Successfully';

        }


        return array(

            "success" => $success,
            "msg" => $msg,
            "id" => $id


        );




    }


    public static function deletePredefinedReply($id){

        $d = ORM::for_table('sys_canned_responses')->find_one($id);

        if($d){

            $d->delete();

            return true;

        }

        return false;

    }


    public static function departments(){
        $ds = ORM::for_table('sys_ticketdepartments')->select('dname','value')->find_array();
        return $ds;

    }


}