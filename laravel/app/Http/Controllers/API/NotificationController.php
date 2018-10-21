<?php

namespace App\Http\Controllers\API;

use App\Notifications\{TestMessage, SmsMessage};
use App\Models\{DouBanBook, User};
use Notification;

class NotificationController extends Controller
{
    /**
     * @OAS\Get(path="/send_mail",tags={"Notification"},
        summary="Notification Test",description="",
     * @OAS\Parameter(name="id",in="query",description="分类ID",required=false,
     * @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="name",in="query",description="分类名称",required=false,
     * @OAS\Schema(type="string")),
     * @OAS\Response(response=200,description="successful operation"),
     *   
     * )
     *
	**/
    public function sendMail()
    {
        $user = User::find(1);
        $book = DoubanBook::find(1);
        Notification::route('mail', 'byron@ganguo.hk')
            ->notify(new TestMessage($book));

        return \Response::success();
    }

    /**
     * @OAS\Get(path="/send_sms",tags={"Notification"},
        summary="Notification Test from SMS",description="",
     * @OAS\Response(response=200,description="successful operation"),
     *   
     * )
     *
	**/
    public function SmsMessage()
    {
        Notification::route('nexmo', '+86 13610200336')
            ->notify(new SmsMessage());

        return \Response::success();
    }
}
