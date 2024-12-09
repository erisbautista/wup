<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class StrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('strands')->insert([
            [
                'id' => 1,
                'name' => 'stem',
                'description' => 'STEM emphasizes rigorous training in math, science, and engineering concepts, aimed at developing analytical and problem-solving skills.',
                'expectation' => 'Students will engage in intensive study and lab work in physics, biology, chemistry, and calculus. They can expect a challenging curriculum that prepares them for university courses and careers in science, engineering, and technology fields.',
                'created_at' => Date::now(),
            ],
            [
                'id' => 2,
                'name' => 'abm',
                'description' => 'The ABM strand provides students with foundational knowledge in business principles, finance, and management, focusing on the essentials of entrepreneurship and economics.',
                'expectation' => 'Students will explore topics like accounting, marketing, and business ethics, preparing them for careers or studies in business, management, and accounting fields. The coursework includes case studies, financial analysis, and business planning projects.',
                'created_at' => Date::now(),
            ],
            [
                'id' => 3,
                'name' => 'humss',
                'description' => 'HUMSS explores human behavior, society, and culture, providing students with a deep understanding of social sciences, history, and communication.',
                'expectation' => 'Students will study subjects like psychology, political science, and communication arts, developing critical thinking and empathy. They can expect a curriculum filled with discussions, writing assignments, and projects that prepare them for roles in law, education, and social services.',
                'created_at' => Date::now(),
            ],
            [
                'id' => 4,
                'name' => 'gas',
                'description' => 'GAS offers a broad-based curriculum for students who want a mix of subjects from different strands or are undecided about their future path.',
                'expectation' => 'Students will take a variety of subjects across the academic disciplines, allowing them to explore their interests. This strand prepares them for general college courses or further specialization once they decide on a career path.',
                'created_at' => Date::now(),
            ],
            [
                'id' => 5,
                'name' => 'tvl',
                'description' => 'TVL focuses on practical and technical skills, covering fields like agriculture, home economics, industrial arts, and ICT.',
                'expectation' => 'Students will experience hands-on training and skill-based assessments in their chosen field, preparing them for immediate employment or entrepreneurial ventures after high school. The curriculum emphasizes practical applications and industry-standard techniques.',
                'created_at' => Date::now(),
            ],
        ]);
    }
}
