<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsertCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("category")->insert([
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Tin trong ngày","aliasCat"=>"tin-trong-ngay","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Bóng đá","aliasCat"=>"bong-da","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Kinh doanh","aliasCat"=>"kinh-doanh","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"HI-TECH","aliasCat"=>"hi-tech","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Thế giới","aliasCat"=>"the-gioi","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Thể thao","aliasCat"=>"the-thao","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Ngoại hạng anh","aliasCat"=>"ngoai-hang-anh","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Giải trí","aliasCat"=>"giai-tri","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Pháp luật","aliasCat"=>"phap-luat","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Ẩm thực","aliasCat"=>"am-thuc","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Làm đẹp","aliasCat"=>"lam-dep","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Đời sống showbiz","aliasCat"=>"doi-song-showbiz","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Sức khỏe - Gia đình","aliasCat"=>"suc-khoe-gia-dinh","date_addCate"=>now()],
        //   ["parent_ID"=>0,"parentS_ID"=>0,"nameCat"=>"Du lịch","aliasCat"=>"du-lich","date_addCate"=>now()],



          ["parent_ID"=>71,"parentS_ID"=>0,"nameCat"=>"Chính trị - Xã hội","aliasCat"=>"chinh-tri-xa-hoi","date_addCate"=>now()],
          ["parent_ID"=>71,"parentS_ID"=>0,"nameCat"=>"Đời sống - Dân sinh","aliasCat"=>"doi-song-dan-sinh","date_addCate"=>now()],
          ["parent_ID"=>71,"parentS_ID"=>0,"nameCat"=>"Giao thông - Đô thị","aliasCat"=>"giao-thong-do-thi","date_addCate"=>now()],
          ["parent_ID"=>71,"parentS_ID"=>0,"nameCat"=>"Nóng trên mạng","aliasCat"=>"nong-tren-mang","date_addCate"=>now()],
          ["parent_ID"=>71,"parentS_ID"=>0,"nameCat"=>"Vắc xin Covid-19","aliasCat"=>"vac-xin-covid-19","date_addCate"=>now()],
          ["parent_ID"=>71,"parentS_ID"=>0,"nameCat"=>"Dự báo thời tiết","aliasCat"=>"du-bao-thoi-tiet","date_addCate"=>now()],
          ["parent_ID"=>71,"parentS_ID"=>0,"nameCat"=>"Toàn cảnh Covid-19","aliasCat"=>"toan-canh-covid-19","date_addCate"=>now()],


          
        ]);
    }
}
