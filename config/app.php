<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Taipei',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'zh-TW',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,

    ],
    /*
    |--------------------------------------------------------------------------
    | 自訂常數
    |--------------------------------------------------------------------------
    |
    */
    //群組
    'groups' => [
        '1'=>'管理階層',
        '2'=>'國中小學校',
        '4'=>'職探中心',
        '8'=>'高中職學校',
        '16'=>'公司企業',
        '32'=>'職場達人',
    ],
    //鄉鎮
    'townships'=>[
        '500'=>'彰化市',
        '502'=>'芬園鄉',
        '503'=>'花壇鄉',
        '504'=>'秀水鄉',
        '505'=>'鹿港鎮',
        '506'=>'福興鄉',
        '507'=>'線西鄉',
        '508'=>'和美鎮',
        '509'=>'伸港鄉',
        '510'=>'員林市',
        '511'=>'社頭鄉',
        '512'=>'永靖鄉',
        '513'=>'埔心鄉',
        '514'=>'溪湖鎮',
        '515'=>'大村鄉',
        '516'=>'埔鹽鄉',
        '520'=>'田中鎮',
        '521'=>'北斗鎮',
        '522'=>'田尾鄉',
        '523'=>'埤頭鄉',
        '524'=>'溪州鄉',
        '525'=>'竹塘鄉',
        '526'=>'二林鎮',
        '527'=>'大城鄉',
        '528'=>'芳苑鄉',
        '530'=>'二水鄉',
        '999'=>'其他縣市',
    ],

    //技藝職群
    'careers'=>[
        '1'=>'機械職群',
        '2'=>'動力機械職群',
        '3'=>'電機電子職群',
        '4'=>'化工職群',
        '5'=>'土木建築職群',
        '6'=>'商業管理職群',
        '7'=>'外語職群',
        '8'=>'設計職群',
        '9'=>'農業職群',
        '10'=>'食品職群',
        '11'=>'家政職群',
        '12'=>'餐旅職群',
        '13'=>'水產職群',
        '14'=>'海事職群',
        '15'=>'藝術職群',
    ],
    //相關類別及職群
    'visit_careers'=>[
        ''=>'',
        '1'=>'工業類─機械群',
        '2'=>'工業類─動力機械群',
        '3'=>'工業類─電機與電子群',
        '4'=>'工業類─化工群',
        '5'=>'工業類─土木與建築群',
        '6'=>'商業類-商業與管理群',
        '7'=>'商業類-外語群',
        '8'=>'農業類-農業群',
        '9'=>'農業類-食品群',
        '10'=>'家事類-家政群',
        '11'=>'家事類-餐旅群',
        '12'=>'海事水產類-水產群',
        '13'=>'海事水產類-海事群',
        '14'=>'藝術與設計類-藝術群',
        '15'=>'藝術與設計類-設計群',
        '16'=>'醫護職群',
        '17'=>'其他',
    ],
    /*
    'j_schools' => [
        's074535'=>'和群國中',
        's074507'=>'彰德國中',
        's074503'=>'鹿鳴國中',
        's074540'=>'彰泰國中',
        's074524'=>'伸港國中',
        's074502'=>'鹿港國中',
        's074517'=>'芳苑國中',
        's074512'=>'萬興國中',
    ],
    */
    'schools_name' => [                                                                                                                                   
        '074601' => '中山國小',
        '074602' => '民生國小',
        '074603' => '平和國小',
        '074604' => '南郭國小',
        '074605' => '南興國小',
        '074606' => '東芳國小',
        '074607' => '泰和國小',
        '074608' => '三民國小',
        '074609' => '聯興國小',
        '074610' => '大竹國小',
        '074611' => '國聖國小',
        '074612' => '快官國小',
        '074613' => '石牌國小',
        '074614' => '忠孝國小',
        '074775' => '大成國小',        
        '074505' => '陽明國中',
        '074506' => '彰安國中',
        '074507' => '彰德國中',
        '074538' => '彰興國中',        
        '074540' => '彰泰國中',        
        '074615' => '芬園國小',
        '074616' => '富山國小',
        '074617' => '寶山國小',
        '074618' => '同安國小',
        '074619' => '文德國小',
        '074620' => '茄荖國小',
        '074509' => '芬園國中',
        '074621' => '花壇國小',
        '074622' => '文祥國小',
        '074623' => '華南國小',
        '074624' => '僑愛國小',
        '074625' => '三春國小',
        '074626' => '白沙國小',
        '074526' => '花壇國中',
        '074627' => '和美國小',
        '074628' => '和東國小',
        '074629' => '大嘉國小',
        '074630' => '大榮國小',
        '074631' => '新庄國小',
        '074632' => '培英國小',
        '074769' => '和仁國小',        
        '074535' => '和群國中',
        '074633' => '線西國小',
        '074634' => '曉陽國小',
        '074504' => '線西國中',
        '074635' => '新港國小',
        '074636' => '伸東國小',
        '074637' => '伸仁國小',
        '074638' => '大同國小',
        '074524' => '伸港國中',    
        '074639' => '鹿港國小',
        '074640' => '文開國小',
        '074641' => '洛津國小',
        '074642' => '海埔國小',
        '074643' => '新興國小',
        '074644' => '草港國小',
        '074645' => '頂番國小',
        '074646' => '東興國小',
        '074771' => '鹿東國小',
        '074502' => '鹿港國中',
        '074503' => '鹿鳴國中',        
        '074647' => '管嶼國小',
        '074648' => '文昌國小',
        '074649' => '西勢國小',
        '074650' => '大興國小',
        '074651' => '永豐國小',
        '074652' => '日新國小',
        '074653' => '育新國小',
        '074521' => '福興國中',  
        '074654' => '秀水國小',
        '074655' => '馬興國小',
        '074656' => '華龍國小',
        '074657' => '明正國小',
        '074658' => '陝西國小',
        '074659' => '育民國小',
        '074522' => '秀水國中',   
        '074660' => '溪湖國小',
        '074661' => '東溪國小',
        '074662' => '湖西國小',
        '074663' => '湖東國小',
        '074664' => '湖南國小',
        '074665' => '媽厝國小',
        '074518' => '溪湖國中',        
        '074666' => '埔鹽國小',
        '074667' => '大園國小',
        '074668' => '南港國小',
        '074669' => '好修國小',
        '074670' => '永樂國小',
        '074671' => '新水國小',
        '074672' => '天盛國小',
        '074519' => '埔鹽國中',
        '074673' => '埔心國小',
        '074674' => '太平國小',
        '074675' => '舊館國小',
        '074676' => '羅厝國小',
        '074677' => '鳳霞國小',
        '074678' => '梧鳳國小',
        '074679' => '明聖國小',
        '074520' => '埔心國中',
        '074680' => '員林國小',
        '074681' => '育英國小',
        '074682' => '靜修國小',
        '074683' => '僑信國小',
        '074684' => '員東國小',
        '074687' => '青山國小',
        '074685' => '饒明國小',
        '074686' => '東山國小',        
        '074688' => '明湖國小',
        '074510' => '員林國中',
        '074511' => '明倫國中',
        '074536' => '大同國中',
        '074689' => '大村國小',
        '074690' => '大西國小',
        '074691' => '村上國小',
        '074692' => '村東國小',
        '074525' => '大村國中',   
        '074693' => '永靖國小',
        '074694' => '福德國小',
        '074695' => '永興國小',
        '074696' => '福興國小',
        '074697' => '德興國小',
        '074527' => '永靖國中',    
        '074698' => '田中國小',
        '074699' => '三潭國小',
        '074700' => '大安國小',
        '074701' => '內安國小',
        '074702' => '東和國小',
        '074703' => '明禮國小',
        '074776' => '新民國小',        
        '074704' => '社頭國小',
        '074705' => '橋頭國小',
        '074706' => '朝興國小',
        '074707' => '清水國小',
        '074708' => '湳雅國小',
        '074773' => '崙雅國小',
        '074772' => '舊社國小',    
        '074530' => '社頭國中',    
        '074709' => '二水國小',
        '074710' => '復興國小',
        '074711' => '源泉國小',
        '074529' => '二水國中',
        '074712' => '北斗國小',
        '074713' => '萬來國小',
        '074714' => '螺青國小',
        '074715' => '大新國小',
        '074716' => '螺陽國小',
        '074501' => '北斗國中',
        '074717' => '田尾國小',
        '074718' => '南鎮國小',
        '074719' => '陸豐國小',
        '074720' => '仁豐國小',
        '074531' => '田尾國中',
        '074721' => '埤頭國小',
        '074722' => '合興國小',
        '074723' => '豐崙國小',
        '074724' => '芙朝國小',
        '074725' => '中和國小',
        '074726' => '大湖國小',
        '074534' => '埤頭國中',     
        '074727' => '溪州國小',
        '074728' => '僑義國小',
        '074729' => '三條國小',
        '074730' => '水尾國小',
        '074731' => '潮洋國小',
        '074732' => '成功國小',
        '074733' => '圳寮國小',
        '074734' => '大莊國小',
        '074735' => '南州國小',
        '074532' => '溪州國中',   
        '074533' => '溪陽國中',
        '074736' => '二林國小',
        '074737' => '興華國小',
        '074738' => '中正國小',
        '074739' => '育德國小',
        '074740' => '香田國小',
        '074741' => '廣興國小',
        '074742' => '萬興國小',
        '074743' => '新生國小',
        '074744' => '中興國小',        
        '074746' => '萬合國小',
        '074777' => '湖北國小',
        '074512' => '萬興國中',        
        '074747' => '大城國小',
        '074748' => '永光國小',
        '074749' => '西港國小',
        '074750' => '美豐國小',
        '074751' => '頂庄國小',
        '074752' => '潭墘國小',
        '074515' => '大城國中',
        '074753' => '竹塘國小',
        '074754' => '田頭國小',
        '074755' => '民靖國小',
        '074756' => '長安國小',
        '074757' => '土庫國小',
        '074514' => '竹塘國中',
        '074758' => '芳苑國小',
        '074765' => '王功國小',
        '074759' => '後寮國小',        
        '074761' => '育華國小',
        '074762' => '草湖國小',
        '074763' => '建新國小',
        '074764' => '漢寶國小',        
        '074766' => '新寶國小',
        '074767' => '路上國小',
        '074517' => '芳苑國中',
        '074516' => '草湖國中',
        '074308' => '彰化藝術高中',
        '074313' => '二林高中',        
        '074339' => '成功高中',                                                        
        '074323' => '和美高中',           
        '074328' => '田中高中',
        '074541' => '信義國中小',                
        '074542' => '鹿江國中(小)',  
        '074778' => '鹿江國(中)小',          
        '074543' => '民權華德福國中(小)',        
        '074760' => '民權華德福國(中)小',        
        '074537' => '原斗國中(小)',               
        '074745' => '原斗國(中)小',      
    ],   

];
