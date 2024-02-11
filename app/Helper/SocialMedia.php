<?php
namespace App\Helper;
class SocialMedia{
    public static function getName(){
        return [
            [
                'name' => 'Facebook',
                'icon' => 'fab fa-facebook-f',
                'color' => '#39569E',
            ],
            [
                'name' => 'Youtube',
                'icon' => 'fab fa-youtube',
                'color' => '#DC472E'
            ],
            [
                'name' => 'Twitter',
                'icon' => 'fab fa-twitter',
                'color' => '#52AAF4'
            ],
            [
                'name' => 'Instagram',
                'icon' => 'fab fa-instagram',
                'color' => '#C8359D'
            ],
            [
                'name' => 'LinkedIn',
                'icon' => 'fab fa-linkedin-in',
                'color' => '#0185AE'
            ]
        ];
    }
}
