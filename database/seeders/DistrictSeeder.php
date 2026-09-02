<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            // ঢাকা বিভাগ (13)
            ['name_bn' => 'ঢাকা', 'name_en' => 'Dhaka', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'ফরিদপুর', 'name_en' => 'Faridpur', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'গাজীপুর', 'name_en' => 'Gazipur', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'গোপালগঞ্জ', 'name_en' => 'Gopalganj', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'কিশোরগঞ্জ', 'name_en' => 'Kishoreganj', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'মাদারীপুর', 'name_en' => 'Madaripur', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'মানিকগঞ্জ', 'name_en' => 'Manikganj', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'মুন্সীগঞ্জ', 'name_en' => 'Munshiganj', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'নারায়ণগঞ্জ', 'name_en' => 'Narayanganj', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'নরসিংদী', 'name_en' => 'Narsingdi', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'রাজবাড়ী', 'name_en' => 'Rajbari', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'শরীয়তপুর', 'name_en' => 'Shariatpur', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],
            ['name_bn' => 'টাঙ্গাইল', 'name_en' => 'Tangail', 'division_bn' => 'ঢাকা', 'division_en' => 'Dhaka'],

            // চট্টগ্রাম বিভাগ (11)
            ['name_bn' => 'বান্দরবান', 'name_en' => 'Bandarban', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'ব্রাহ্মণবাড়িয়া', 'name_en' => 'Brahmanbaria', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'চাঁদপুর', 'name_en' => 'Chandpur', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'চট্টগ্রাম', 'name_en' => 'Chattogram', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'কুমিল্লা', 'name_en' => 'Cumilla', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'কক্সবাজার', 'name_en' => "Cox's Bazar", 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'ফেনী', 'name_en' => 'Feni', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'খাগড়াছড়ি', 'name_en' => 'Khagrachari', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'লক্ষ্মীপুর', 'name_en' => 'Lakshmipur', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'নোয়াখালী', 'name_en' => 'Noakhali', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],
            ['name_bn' => 'রাঙ্গামাটি', 'name_en' => 'Rangamati', 'division_bn' => 'চট্টগ্রাম', 'division_en' => 'Chattogram'],

            // রাজশাহী বিভাগ (8)
            ['name_bn' => 'বগুড়া', 'name_en' => 'Bogura', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],
            ['name_bn' => 'চাঁপাইনবাবগঞ্জ', 'name_en' => 'Chapainawabganj', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],
            ['name_bn' => 'জয়পুরহাট', 'name_en' => 'Joypurhat', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],
            ['name_bn' => 'নওগাঁ', 'name_en' => 'Naogaon', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],
            ['name_bn' => 'নাটোর', 'name_en' => 'Natore', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],
            ['name_bn' => 'পাবনা', 'name_en' => 'Pabna', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],
            ['name_bn' => 'রাজশাহী', 'name_en' => 'Rajshahi', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],
            ['name_bn' => 'সিরাজগঞ্জ', 'name_en' => 'Sirajganj', 'division_bn' => 'রাজশাহী', 'division_en' => 'Rajshahi'],

            // খুলনা বিভাগ (10)
            ['name_bn' => 'বাগেরহাট', 'name_en' => 'Bagerhat', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'চুয়াডাঙ্গা', 'name_en' => 'Chuadanga', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'যশোর', 'name_en' => 'Jashore', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'ঝিনাইদহ', 'name_en' => 'Jhenaidah', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'খুলনা', 'name_en' => 'Khulna', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'কুষ্টিয়া', 'name_en' => 'Kushtia', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'মাগুরা', 'name_en' => 'Magura', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'মেহেরপুর', 'name_en' => 'Meherpur', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'নড়াইল', 'name_en' => 'Narail', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],
            ['name_bn' => 'সাতক্ষীরা', 'name_en' => 'Satkhira', 'division_bn' => 'খুলনা', 'division_en' => 'Khulna'],

            // বরিশাল বিভাগ (6)
            ['name_bn' => 'বরগুনা', 'name_en' => 'Barguna', 'division_bn' => 'বরিশাল', 'division_en' => 'Barishal'],
            ['name_bn' => 'বরিশাল', 'name_en' => 'Barishal', 'division_bn' => 'বরিশাল', 'division_en' => 'Barishal'],
            ['name_bn' => 'ভোলা', 'name_en' => 'Bhola', 'division_bn' => 'বরিশাল', 'division_en' => 'Barishal'],
            ['name_bn' => 'ঝালকাঠি', 'name_en' => 'Jhalokati', 'division_bn' => 'বরিশাল', 'division_en' => 'Barishal'],
            ['name_bn' => 'পটুয়াখালী', 'name_en' => 'Patuakhali', 'division_bn' => 'বরিশাল', 'division_en' => 'Barishal'],
            ['name_bn' => 'পিরোজপুর', 'name_en' => 'Pirojpur', 'division_bn' => 'বরিশাল', 'division_en' => 'Barishal'],

            // সিলেট বিভাগ (4)
            ['name_bn' => 'হবিগঞ্জ', 'name_en' => 'Habiganj', 'division_bn' => 'সিলেট', 'division_en' => 'Sylhet'],
            ['name_bn' => 'মৌলভীবাজার', 'name_en' => 'Moulvibazar', 'division_bn' => 'সিলেট', 'division_en' => 'Sylhet'],
            ['name_bn' => 'সুনামগঞ্জ', 'name_en' => 'Sunamganj', 'division_bn' => 'সিলেট', 'division_en' => 'Sylhet'],
            ['name_bn' => 'সিলেট', 'name_en' => 'Sylhet', 'division_bn' => 'সিলেট', 'division_en' => 'Sylhet'],

            // রংপুর বিভাগ (8)
            ['name_bn' => 'দিনাজপুর', 'name_en' => 'Dinajpur', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],
            ['name_bn' => 'গাইবান্ধা', 'name_en' => 'Gaibandha', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],
            ['name_bn' => 'কুড়িগ্রাম', 'name_en' => 'Kurigram', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],
            ['name_bn' => 'লালমনিরহাট', 'name_en' => 'Lalmonirhat', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],
            ['name_bn' => 'নীলফামারী', 'name_en' => 'Nilphamari', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],
            ['name_bn' => 'পঞ্চগড়', 'name_en' => 'Panchagarh', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],
            ['name_bn' => 'রংপুর', 'name_en' => 'Rangpur', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],
            ['name_bn' => 'ঠাকুরগাঁও', 'name_en' => 'Thakurgaon', 'division_bn' => 'রংপুর', 'division_en' => 'Rangpur'],

            // ময়মনসিংহ বিভাগ (4)
            ['name_bn' => 'জামালপুর', 'name_en' => 'Jamalpur', 'division_bn' => 'ময়মনসিংহ', 'division_en' => 'Mymensingh'],
            ['name_bn' => 'ময়মনসিংহ', 'name_en' => 'Mymensingh', 'division_bn' => 'ময়মনসিংহ', 'division_en' => 'Mymensingh'],
            ['name_bn' => 'নেত্রকোণা', 'name_en' => 'Netrokona', 'division_bn' => 'ময়মনসিংহ', 'division_en' => 'Mymensingh'],
            ['name_bn' => 'শেরপুর', 'name_en' => 'Sherpur', 'division_bn' => 'ময়মনসিংহ', 'division_en' => 'Mymensingh'],
        ];

        foreach ($districts as $d) {
            District::firstOrCreate(
                ['name_bn' => $d['name_bn']],
                $d
            );
        }
    }
}
