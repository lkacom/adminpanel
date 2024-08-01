<?php
namespace App\Helpers;

use Http;
use Storage;
use Str;

class V2ray
{
    public $client_id;
    public $subscription;
    public $config;

    public $protocol;
    public $stream;
    public $uuid;
    public $cleanIp;
    public $sni;
    public $port;
    public $path            ='/';
    public $tls             = true;
    public $mux;
    public $insecure;
    public $concurrency;
    public $packets         = 'tlshello';
    public $length          = '10-20';
    public $interval        = '1-2';
    public $grpcMode;
    public $serviceName;
    public $fingerprint     = 'chrome';
    public $direct;
    public $appName;
    public $remarks;
    public $fragment;

//    protected $loginUrl         = 'https://st.ad24.top:2053/panel/login';
//    protected $APIUrl           = 'https://st.ad24.top:2053/panel/xui/API';
//    protected $SubscriptionUrl  = 'https://subs.ad24.top:2096/subs';
//    protected $username         = 'hamed';
//    protected $password         = 'hamed123@';

    protected string $APIUrl           = 'https://ad24.strangled.net:2087/panel';
    protected string $APIPath          = '/panel/api/inbounds';
    protected string $SubscriptionUrl  = 'https://sub.ad24.top:2096/subs';
    protected string $username         = 'hamed';
    protected string $password         = 'hamed123@';

    public function __construct()
    {
        $this->fragment = json_decode(Storage::get('fragment.json'));
    }

    public function createClient($user,$expiryTime = 0)
    {
        $this->client_id = 't'.rand(10000, 99999).'-'.Str::limit($user->email, 23,'');
        $cookie = $this->v2rayLogin()->cookies();
        $settings = collect(
            [
                "clients" =>
                    [
                        0 => [
                            "id"            => str_replace('@','-',$this->client_id),
                            "alterId"       => 0,
                            "email"         => $this->client_id,
                            "limitIp"       => 2,
                            "totalGB"       => 0,
                            "expiryTime"    => $expiryTime,
                            "enable"        => true,
                            "tgId"          => null,
                            "subId"         => $this->client_id,
                        ]
                    ]
            ]
        );

        //Connect to V2Ray API Service
        $response = Http::withOptions(['cookies' => $cookie])->post($this->APIUrl.$this->APIPath.'/addClient', [
            'id' => 5,
            'settings' => $settings->toJson(),
        ]);
        $result = $response->object();
        if($result->success){
            $this->subscription = $this->SubscriptionUrl.'/'.$this->client_id;
            $this->createFragment();
            return $this;
        }

        exit('Error 6574');
    }

    protected function createFragment()
    {
        $response = Http::get($this->subscription);
        $this->config = base64_decode($response->body());
        $this->parseConfig();
        return $this->generateJson();
    }

    protected function generateJson()
    {
        $this->fragment->remarks = $this->remarks;
        if ($this->appName === 'nekoray') {
            $this->fragment->inbounds[0]->port = 2080;
            $this->fragment->inbounds[1]->port = 2081;
        } else {
            $this->fragment->inbounds[0]->port = 10808;
            $this->fragment->inbounds[1]->port = 10809;
        }
        $this->fragment->outbounds[0]->protocol = $this->protocol;
        if ($this->mux) {
            $this->fragment->outbounds[0]->mux->enabled = true;
            $this->fragment->outbounds[0]->mux->concurrency = $this->concurrency;
            $this->fragment->outbounds[0]->mux->xudpConcurrency = $this->concurrency;
        } else {
            unset($this->fragment->outbounds[0]->mux);
        }
        $this->fragment->outbounds[0]->streamSettings->network = $this->stream;
        if ($this->stream === "grpc") {
            unset($this->fragment->outbounds[0]->streamSettings->wsSettings);
            $this->fragment->outbounds[0]->streamSettings->grpcSettings->multiMode = $this->grpcMode === 'multi';
            $this->fragment->outbounds[0]->streamSettings->grpcSettings->serviceName = $this->serviceName;
        } else {
            unset($this->fragment->outbounds[0]->streamSettings->grpcSettings);
            $this->fragment->outbounds[0]->streamSettings->wsSettings->headers->Host = $this->sni;
            $this->fragment->outbounds[0]->streamSettings->wsSettings->path = $this->path;
        }
        $this->fragment->outbounds[0]->streamSettings->tlsSettings->allowInsecure = (bool)$this->insecure;
        $this->fragment->outbounds[0]->streamSettings->tlsSettings->serverName = $this->sni;
        $this->fragment->outbounds[0]->streamSettings->tlsSettings->fingerprint = $this->fingerprint;
        $this->fragment->outbounds[1]->settings->fragment->packets = $this->packets;
        $this->fragment->outbounds[1]->settings->fragment->length = $this->length;
        $this->fragment->outbounds[1]->settings->fragment->interval = $this->interval;
        if ($this->protocol === 'trojan') {
            $this->fragment->outbounds[0]->settings->servers[0]->port = $this->port;
            $this->fragment->outbounds[0]->settings->servers[0]->password = $this->uuid;
            $this->fragment->outbounds[0]->settings->servers[0]->address = $this->cleanIp;
            unset($this->fragment->outbounds[0]->settings->vnext);
        } else {
            $this->fragment->outbounds[0]->settings->vnext[0]->port = $this->port;
            $this->fragment->outbounds[0]->settings->vnext[0]->users[0]->id = $this->uuid;
            $this->fragment->outbounds[0]->settings->vnext[0]->address = $this->cleanIp;
            unset($this->fragment->outbounds[0]->settings->servers);
        }
        if ($this->tls) {
            $this->fragment->outbounds[0]->streamSettings->security = "tls";
        } else {
            unset($this->fragment->outbounds[0]->streamSettings->tlsSettings);
            unset($this->fragment->outbounds[0]->streamSettings->security);
        }
        //echo QrCode::size(600)->generate(json_encode($this->fragment))."<br>";
        //return response()->json($this->fragment,200,[],JSON_PRETTY_PRINT);
        return $this->fragment;
        //exit(json_encode($this->fragment));
    }

    protected function parseConfig(){
        $config = parse_url($this->config);
        parse_str($config['query'],$config['query']);

        $this->remarks  = $config['fragment'];
        $this->protocol = $config['scheme'];
        $this->port     = $config['port'];
        $this->sni      = $config['query']['sni'];
        $this->uuid     = $config['user'];
        $this->stream   = $config['query']['type'];
        $this->cleanIp  = $config['host'];
        //$this->path     = $config['query']['path'];
    }

    protected function v2rayLogin(){
        try {
            $response = Http::post($this->APIUrl.'/login', [
                'username' => $this->username,
                'password' => $this->password
            ]);
            if ($response->successful()) {
                $result = $response->object();
                if($result->success)
                    return $response;
            }
            exit('Error');
        }
        catch (\exception $e){
            dd($e->getMessage());
            //throw new InvalidArgumentException('yyy.',401);
        }

    }

}
