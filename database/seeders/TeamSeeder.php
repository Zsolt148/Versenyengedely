<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO CHECK TEAM NAMES
        $teams = [
            [
                'name' => 'Algyői Úszó és Vízisport Egyesület',
                'SA' => '35',
                'address' => '6750 Algyő, Sport u. 9.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BÁCSVÍZ Kecskeméti Vízmű Sport Club',
                'SA' => '31',
                'address' => '6000 Kecskemét, Izsáki út 13.',
                'webpage' => 'http://kvsc.info',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Balaton Úszó Klub',
                'SA' => '94',
                'address' => '8200 Veszprém, Veszprémvölgyi út 3.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BEAC Budapesti Egyetemi Atlétikai Club Sportegyesület',
                'SA' => '71',
                'address' => '1112 Budapest, Bogdánffy Ödön u. 10',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Békéscsabai Senior Úszó Egyesület',
                'SA' => '3',
                'address' => '5600 Békéscsaba, Bánát u 34.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Berettyó Cápák SE',
                'SA' => '86',
                'address' => '4100 Berettyóújfalu, Bocskai utca 84.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bohóchal Egyesület',
                'SA' => '40',
                'address' => '1163 Budapest, Bányai Elemér u.12.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budafóka XXII. Sportegyesület',
                'SA' => '58',
                'address' => '1222 Budapest, Nagytétényi út 31-33',
                'webpage' => 'http://www.budafokase.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delfin Sportegyesület',
                'SA' => '2',
                'address' => '1138 Budapest, Népfürdő utca 35. II/5',
                'webpage' => 'http://www.budapestidelfinek.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budapesti Honvéd SE',
                'SA' => '75',
                'address' => '1134 Budapest, Dózsa György út 53.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budapesti Vasutas Sport Club-Zugló',
                'SA' => '49',
                'address' => '1142 Budapest, Szőnyi út 2.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Csobogó 17 Egyesület',
                'SA' => '50',
                'address' => '1174 Budapest, Ady Endre u. 67.',
                'webpage' => 'http://www.uszasoktatas17.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Csongrádi Senior',
                'SA' => '17',
                'address' => '6640 Csongrád, Tanya 827/A',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Debreceni Szenior Úszó Klub',
                'SA' => '4',
                'address' => '4800 Debrecen, Zoltai Lajos u. 11',
                'webpage' => 'http://www.dszuk.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dombóvári Sportiskola Egyesület',
                'SA' => '87',
                'address' => '7200 Dombóvár, Ivanich Antal u. 76.',
                'webpage' => 'http://uszasdsi.gportal.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Regele Károly Szenior Úszóklub',
                'SA' => '5',
                'address' => '5700 Gyula, Bocskai u. 13',
                'webpage' => 'http://www.magyar.sport.hu/uszas/regele/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dunakanyar Szabadidősport és Kulturális Egyesület',
                'SA' => '65',
                'address' => '2000 Szentendre, Rózsa köz 4/2 fsz.1	',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eger Városi Úszóklub',
                'SA' => '36',
                'address' => '3300 Eger, Frank Tivadar utca 5.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Egri Szenior Úszó Klub',
                'SA' => '11',
                'address' => '3300 Eger, Szvorényi u.5.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Esztergomi Úszó Klub',
                'SA' => '85',
                'address' => '2500 Esztergom, Basa utca 13/4.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Family Tree Triatlon és Szabadidős Sportegyesület',
                'SA' => '89',
                'address' => '8000 Székesfehérvár, Szedreskerti lakónegyed 30. fszt. 2.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ferencvárosi Torna Club',
                'SA' => '24',
                'address' => '1091 Budapest, Üllői út 129.',
                'webpage' => 'http://www.ftcswimmasters.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Győri Zabolátlan Sportegyesület',
                'SA' => '37',
                'address' => '9012 Győr, Hegyalja u. 78.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Herceghalmi Sportegyesület',
                'SA' => '63',
                'address' => '2053 Herceghalom, Liget utca 2.',
                'webpage' => 'http://www.herceghalmise.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HÓD Úszó Sport Egyesület',
                'SA' => '53',
                'address' => '6800 Hódmezővásárhely, Ady Endre u. 1.',
                'webpage' => 'http://www.hoduszo.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hód-Triatlon és Öttusa Sport Egyesület',
                'SA' => '90',
                'address' => '6800 Hódmezővásárhely, Garzó Imre u. 4/b',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hullám 91 Úszó és Vízilabda Egyesület',
                'SA' => '52',
                'address' => '8000 Székesfehérvár, Kadocsa u. 23',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Iron Corporation Kft. - Iron Aquatics	66',
                'SA' => '66',
                'address' => '1025 Budapest, Mandula utca 28 fsz.2',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kaposvári Arena Senior Vízilabda és Úszó Klub Egyesület',
                'SA' => '74',
                'address' => '7400 Kaposvár, Irányi Dániel utca 5.	',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kistarcsai Vízisport és Rekreációs Club',
                'SA' => '69',
                'address' => '2143 Kistarcsa, Széchenyi u. 33	',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Magyar Nemzeti Bank Sportkör',
                'SA' => '76',
                'address' => '1050 Budapest, Szabdság tér 8-9.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Megathlon Sport Egyesület',
                'SA' => '84',
                'address' => '1119 Budapest, Fehérvári út 63. 2/2',
                'webpage' => 'http://megathlon.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mezőtúri Szenior',
                'SA' => '25',
                'address' => '5400 Mezőtúr, Táncsics u. 6.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Miskolci Vízművek Sport Club',
                'SA' => '38',
                'address' => '3530 Miskolc, Széchenyi u. 6/B.2/6',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Natural Immune Control System - Hódmezővásárhelyi Szenior Úszó és Vizilabda Club',
                'SA' => '1',
                'address' => '6800 Hódmezővásárhely, Ady E. u. 1.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nyíregyházi Fókák SE',
                'SA' => '82',
                'address' => '4400 Nyíregyháza, Széchenyi u. 17.',
                'webpage' => 'http://www.fokak.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nyírsenior 97 SE',
                'SA' => '12',
                'address' => '4400 Nyíregyháza, Korányi u. 127.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orvosegyetem Sport Club',
                'SA' => '56',
                'address' => '1052 Budapest, Semmelweis u. 2',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parafa Úszó Klub Gyöngyös',
                'SA' => '95',
                'address' => '3200 Gyöngyös, Epreskert u. 47.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pécs-Baranyai Szenior Úszók és Vízisportolók Klubja',
                'SA' => '16',
                'address' => '7624 Pécs, Szent István tér 17.',
                'webpage' => 'http://szenioruszok.uw.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pécsi Vörös Meteor Sportkör',
                'SA' => '54',
                'address' => '7627 Pécs, Alajos u. 2/2',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pénzügyőr SE',
                'SA' => '42',
                'address' => '1103 Budapest, Kőér u. 2/B.',
                'webpage' => 'http://www.penzugyorse.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rév és Társai Sport Club',
                'SA' => '45',
                'address' => '1101 Budapest, Kőbányai út 49/b',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spuri Futó és Triatlon Sportklub',
                'SA' => '45',
                'address' => '1114 Budapest, Eszék u. 6/b IV. 1.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Szarvasi Úszó és Vizilabda Sportegyesület',
                'SA' => '22',
                'address' => '5540 Szarvas, Kossuth utca 23.',
                'webpage' => 'http://www.szuse.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Százhalombattai VUK SE',
                'SA' => '41',
                'address' => '2440 Százhalombatta, Kertész u. 42',
                'webpage' => 'http://www.vuk-se.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Széchy Tamás Sportiskola Sopron',
                'SA' => '33',
                'address' => '9400 Sopron, Bécsi u. 2. 1/6.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Szegedi Deres Szenior és Tömegsport Egyesület (SZEDER SE)',
                'SA' => '70',
                'address' => '6724 Szeged, Jakab László u. 14. fsz. 13.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Szentesi Delfin Egészségmegőrző Sport Club',
                'SA' => '6',
                'address' => '6600 Szentes, Koszta József u. 2.	',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Szombathelyi Sportközpont és Sportiskola Nonprofit Kft.',
                'SA' => '83',
                'address' => '9700 Szombathely, Sugár út 18.',
                'webpage' => 'http://www.szombathelyisport.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tatabányai Vízmű Sportegyesület',
                'SA' => '47',
                'address' => '2800 Tatabánya, Ságvári E. u. 9.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Törökbálinti Senior Úszó Club',
                'SA' => '13',
                'address' => '2040 Budaörs, Hortenzia u.3',
                'webpage' => 'http://www.ujbudasenior.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tótkomlósi Rozmár Szenior Úszó Klub Egyesület',
                'SA' => '20',
                'address' => '5940 Tótkomlós, Zamenhof utca 5.',
                'webpage' => 'http://www.totkomlosirozmarok.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tovafutók Sportegyesület',
                'SA' => '77',
                'address' => '8400 Ajka, Szabadság tér 4/A	',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Triton Sport Egyesület',
                'SA' => '28',
                'address' => '5700 Gyula, Vásárhelyi Pál u. 4.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Újpesti Torna Egylet',
                'SA' => '73',
                'address' => '1044 Budapest, Megyeri út 13.',
                'webpage' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Váci Vízmű SE',
                'SA' => '59',
                'address' => '2600 Vác, Ady Endre Sétány 16.',
                'webpage' => 'http://www.vvse.hu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('teams')->insert($teams);
    }
}