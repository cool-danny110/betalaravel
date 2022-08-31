<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Models\DefaultSetting;


class SettingController extends Controller
{
    protected $user_id;
    protected $world_timezone;

    public function __construct() {
        $this->user_id = Cache::get('userId');

        $this->world_timezone = [
            ['id'=>1,'value'=>'-12:00', 'name'=>'(GMT -12:00) Eniwetok Kwajalein'],
            ['id'=>2, 'value'=>'-11:00', 'name'=>'(GMT -11:00) Midway Island, Samoa'],
            ['id'=>3, 'value'=>'-10:00', 'name'=>'(GMT -10:00) Hawaii'],
            ['id'=>4, 'value'=>'-09:50', 'name'=>'(GMT -9:30) Taiohae'],
            ['id'=>5, 'value'=>'-09:00', 'name'=>'(GMT -9:00) Alaska'],
            ['id'=>6, 'value'=>'-08:00', 'name'=>'(GMT -8:00) Pacific Time [US &amp; Canada)'],
            ['id'=>7, 'value'=>'-07:00', 'name'=>'(GMT -7:00) Mountain Time [US &amp; Canada)'],
            ['id'=>8, 'value'=>'-06:00', 'name'=>'(GMT -6:00) Central Time [US &amp; Canada], Mexico City'],
            ['id'=>9, 'value'=>'-05:00', 'name'=>'(GMT -5:00) Eastern Time [US &amp; Canada], Bogota, Lima'],
            ['id'=>10, 'value'=>'-04:50', 'name'=>'(GMT -4:30) Caracas'],
            ['id'=>11, 'value'=>'-04:00', 'name'=>'(GMT -4:00) Atlantic Time [Canada], Caracas, La Paz'],
            ['id'=>12, 'value'=>'-03:50', 'name'=>'(GMT -3:30) Newfoundland'],
            ['id'=>13, 'value'=>'-03:00', 'name'=>'(GMT -3:00) Brazil, Buenos Aires, Georgetown'],
            ['id'=>14, 'value'=>'-02:00', 'name'=>'(GMT -2:00) Mid-Atlantic'],
            ['id'=>15, 'value'=>'-01:00', 'name'=>'(GMT -1:00) Azores, Cape Verde Islands'],
            ['id'=>16, 'value'=>'+00:00', 'name'=>'(GMT) Western Europe Time, London, Lisbon, Casablanca'],
            ['id'=>17, 'value'=>'+01:00', 'name'=>'(GMT +1:00) Brussels, Copenhagen, Madrid, Paris'],
            ['id'=>18, 'value'=>'+02:00', 'name'=>'(GMT +2:00) Kaliningrad, South Africa'],
            ['id'=>19, 'value'=>'+03:00', 'name'=>'(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg'],
            ['id'=>20, 'value'=>'+03:50', 'name'=>'(GMT +3:30) Tehran'],
            ['id'=>21, 'value'=>'+04:00', 'name'=>'(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi'],
            ['id'=>22, 'value'=>'+04:50', 'name'=>'(GMT +4:30) Kabul'],
            ['id'=>23, 'value'=>'+05:00', 'name'=>'(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent'],
            ['id'=>24, 'value'=>'+05:50', 'name'=>'(GMT +5:30) Bombay, Calcutta, Madras, New Delhi'],
            ['id'=>25, 'value'=>'+05:75', 'name'=>'(GMT +5:45) Kathmandu, Pokhar'],
            ['id'=>26, 'value'=>'+06:00', 'name'=>'(GMT +6:00) Almaty, Dhaka, Colombo'],
            ['id'=>27, 'value'=>'+06:50', 'name'=>'(GMT +6:30) Yangon, Mandalay'],
            ['id'=>28, 'value'=>'+07:00', 'name'=>'(GMT +7:00) Bangkok, Hanoi, Jakarta'],
            ['id'=>29, 'value'=>'+08:00', 'name'=>'(GMT +8:00) Beijing, Perth, Singapore, Hong Kong'],
            ['id'=>30, 'value'=>'+08:75', 'name'=>'(GMT +8:45) Eucla'],
            ['id'=>31, 'value'=>'+09:00', 'name'=>'(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk'],
            ['id'=>32, 'value'=>'+09:50', 'name'=>'(GMT +9:30) Adelaide, Darwin'],
            ['id'=>33, 'value'=>'+10:00', 'name'=>'(GMT +10:00) Eastern Australia, Guam, Vladivostok'],
            ['id'=>34, 'value'=>'+10:50', 'name'=>'(GMT +10:30) Lord Howe Island'],
            ['id'=>35, 'value'=>'+11:00', 'name'=>'(GMT +11:00) Magadan, Solomon Islands, New Caledonia'],
            ['id'=>36, 'value'=>'+11:50', 'name'=>'(GMT +11:30) Norfolk Island'],
            ['id'=>37, 'value'=>'+12:00', 'name'=>'(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka'],
            ['id'=>38, 'value'=>'+12:75', 'name'=>'(GMT +12:45) Chatham Islands'],
            ['id'=>39, 'value'=>'+13:00', 'name'=>'(GMT +13:00) Apia, Nukualofa'],
            ['id'=>40, 'value'=>'+14:00', 'name'=>'(GMT +14:00) Line Islands, Tokelau'],
        ];
    }

    //index view
    function index(Request $request) {       
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        return view('settings.index');
    }

    function default() {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        $default_setting = DefaultSetting::where('user_id', $this->user_id)->first();
        return view('settings.default', ['default_setting' => $default_setting, 'world_timezone' => $this->world_timezone]);
    }

    function default_save(Request $request) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        DefaultSetting::updateOrCreate(
            ['user_id' => $this->user_id],
            ['user_id' => $this->user_id, 
            'timezone' => $request->timezone,
            'delay_time' => $request->delay_time,
            'time_format' => $request->time_format,
            'date_format' => $request->date_format,
            'image_url_hide' => $request->image_url_hide,
            'disable_notification' => $request->disable_notification,
            'default_from_name' => $request->default_from_name,
            'default_from_email' => $request->default_from_email,
            'default_header' => $request->default_header,
            'default_footer' => $request->default_footer,
            'default_reply_to' => $request->default_reply_to]
        );
        return redirect()->back()->with('success', 'Your default setting is saved successfully');;
    }
}
