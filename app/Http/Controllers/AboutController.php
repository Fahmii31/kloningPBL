<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        // Welcome section data
        $welcomeText = "Tim ini ada sejak Februari 2025, dimana tim ini berjuang untuk menyelesaikan Project Based Learning (PBL),
        tim ini terdiri dari 4 orang yang tidak pernah satu pikiran,
        hanya ada perdebatan dan ketidaksamaan pendapat, tapi dari kekurangan itu kami
        menciptakan berbagai ide yang akan kami aplikasikan pada projek yang akan kami buat.";

        $welcomeImage = 'image/Anomali2.jpg';

        // Team Members data
        $teamMembers = [
            [
                'name' => 'Steven Marcell Samosir',
                'role' => 'Front-end & Back-end',
                'image' => 'image/tepenbg.png',
                'instagram' => 'https://www.instagram.com/stevensamosir07',
                'gmail' => '#',
                'linkedin' => '#'
            ],
            [
                'name' => 'Aisyah Nurwa Hida',
                'role' => 'Front-end & Back-end',
                'image' => 'image/ais2.png',
                'instagram' => 'https://www.instagram.com/aysh.nrwhd?igsh=MWYwaWZiNmhydXp4',
                'gmail' => '#',
                'linkedin' => '#'
            ],
            [
                'name' => 'Naylah Amirah Az-Zikra',
                'role' => 'Front-end & Back-end',
                'image' => 'image/naylah3.png',
                'instagram' => 'https://www.instagram.com/ndskyx._?igsh=aW43amZod3N4YnRk',
                'gmail' => '#',
                'linkedin' => '#'
            ],
            [
                'name' => 'Fahmi Ahmad Fardani',
                'role' => 'Front-end & Back-end',
                'image' => 'image/Fahmibg.png',
                'instagram' => 'https://www.instagram.com/fhmifrdnii?igsh=MXBpNDN0dGIxcm11Mg==',
                'gmail' => '#',
                'linkedin' => '#'
            ],
        ];

        return view('pages.pembeli.about', compact('welcomeText', 'welcomeImage', 'teamMembers'));
    }
}
