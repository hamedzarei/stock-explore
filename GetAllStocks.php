<?php
/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 7/7/20
 * Time: 8:26 PM
 */

include_once 'vendor/autoload.php';


global $sectors;
$sectors = [
    '33' => 'abzare pezeshki, optiki, andazegiri',
    '10' => 'estekhraje zogalsang',
    '14' => 'estekhraje sayere maaden',
    '11' => 'estekhraje naft o gaz, khadamate janbi joz ekteshaf',
    '13' => 'estekhraje kane haye felezi',
    '73' => 'etelaat va ertebatat',
    '52' => 'anbardari o hemayat az faaliat haye haml o naghl',
    '70' => 'anbuhsazi o amlak o mostaghelat',
    '22' => 'enteshar o chap o taksir',
    '76' => 'oraghe bahadar bar darai fekri',
    '69' => 'oraghe tamin mali',
    '59' => 'oraghe haghe taghadom e estefade az tashilat e maskan',
    '57' => 'bank ha va moassesat e etebari',
    '66' => 'bime o sandog e bazneshastegi be joz tamin ejtemai',
    '45' => 'peimankari e sanati',
    '46' => 'tejarat e omde forushi be joz vasileye naghlie motor',
    '50' => 'tejarat e omde va khorde vasaete naghlie motor',
    '26' => 'tolid e mahsulat e computer electronik o nuri',
    '41' => 'jamavari tasfie o tozie ab',
    '02' => 'jangaldari o mahigiri',
    '61' => 'hamlo naghle abi',
    '51' => 'hamlo naghle havai',
    '60' => 'hamlo naghle, anbardari o ertebatat',
    '74' => 'khadamate fanni o mohandesi',
    '47' => 'khorde forushi be estensnaye vasayele naghlie',
    '34' => 'khodro o sakhte ghataat',
    '19' => 'dabbakhi, pardakht e charm o sakht e anvae papush',
    '72' => 'rayane o faaliat haye vabaste be an',
    '01' => 'zeraat va khadamat e vabaste',
    '32' => 'sakht e dastgaha o vasayele ertebati',
    '28' => 'sakht e mahsulat e felezi',
    '35' => 'sayere tajhizat e hamlo naghl',
    '54' => 'sayere mahsulat e kani e gheyre felez',
    '58' => 'sayere vasete gari haye mali',
    '56' => 'sarmaye gozari ha',
    '53' => 'siman, ahak o gach',
    '39' => 'sherkat haye chand reshte ie sanaati',
    '68' => 'sandoghe sarmaye gozarie ghabele moamele',
    '40' => 'arzeye bargh, gaz, bokhar o ab e garm',
    '23' => 'faravarde haye nafti, kak o sukht e hastei',
    '77' => 'faaliat haye ejare o lizing',
    '82' => 'faaliat e poshtibani ejrai edari o hemayate kasb',
    '71' => 'faaliat e mohandesi, tajzie, tahlil o azmayesh e fanni',
    '63' => 'faaliat e poshtibani o komak e haml o naghl',
    '90' => 'faaliat e honari o sargarmi o khalaghane',
    '93' => 'faaliat e farhangi o varzeshi',
    '67' => 'faaliat haye komak be nahad haye mali e vaset',
    '27' => 'felezat e asasi',
    '38' => 'ghand o shekar',
    '25' => 'lastik o pelastik',
    '29' => 'mashin alat o tajhizat',
    '31' => 'mashin alat o dastgah haye barghi',
    '36' => 'mobleman o masnuate digar',
    '20' => 'mahsulat e chubi',
    '44' => 'mahsulat e shimiyai',
    '42' => 'mahsulat e ghazai o ashamidani be joz ghand',
    '21' => 'mahsulat e kagazi',
    '64' => 'mokhaberat',
    '17' => 'masnujat',
    '43' => 'mavad o mahsulat e darui',
    '55' => 'hotel o resturan',
    '65' => 'vasete gari haye mali o puli',
    '49' => 'kashi o seramik',
];

function getStocks()
{
    global $sectors;
    $client = new \GuzzleHttp\Client(['verify' => false ]);
    $stocks = []; // symbol, name, isin

// https://core.tadbirrlc.com//AlmasDataHandler.ashx?{"Type":"GetMarketMapDataList","selectedType":"vol","sector":"2"}=""&jsoncallback=

    foreach ($sectors as $sector => $sector_name) {
        $sector_stocks = $client->get("https://core.tadbirrlc.com//AlmasDataHandler.ashx?{\"Type\":\"GetMarketMapDataList\",\"selectedType\":\"vol\",\"sector\":\"$sector\"}=\"\"&jsoncallback=");
        $sector_stocks = (string)$sector_stocks->getBody();
        $sector_stocks = json_decode($sector_stocks, true);

        if (!$sector_stocks) continue;
        foreach ($sector_stocks as $sector_stock) {
            $stocks[] = [
                'isin' => $sector_stock['n'],
                'name' => $sector_stock['c'],
                'symbol' => $sector_stock['s'],
            ];
        }
    }

    return $stocks;
}



//var_dump(getStocks());













