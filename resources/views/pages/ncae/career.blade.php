@extends('../../layouts.ncae')

@section('title','Careers')

@section('header')
    <h1>RELATED CAREERS</h1>
    <h2>Discover your future course within the strand you select.</h2>
@endsection

@section('ncae-menu')
    <div class="side-nav" id="menu">
        <p class="fs-2 text-uppercase text-center">SELECT STRAND</p>
        @foreach($strands as $strand)
            <button type="button" onclick="fillCareerInfo({{ $strand }})" id="{{$strand->name}}" class="btn-menu text-center m-5">{{$strand->name}}</button>
        @endforeach
    </div>
@endsection

@section('ncae-content')
    <div class="career">
        <div class="career-wrapper">
            <div class="career-course">
                <h1 class="career-header">Bachelor of Science in Nursing</h1>
                <div class="career-description">
                    <span>Description</span>
                    <p>Focuses on patient care, health promotion, and disease prevention. Prepares students for roles in hospitals, clinics, and community health settings.</p>
                </div>
                <div class="career-expectation">
                    <span>Expectation</span>
                    <p>Expect a challenging yet rewarding journey, with practical clinical experience in hospitals. Nursing often demands long shifts, emotional resilience, and a compassionate approach to patient care.</p>
                </div>
                <span class="career-salary">Expected Starting Salary: <p>₱15,000 - ₱20,000 per month.</p></span>
            </div>
            <div class="career-course">
                <h1 class="career-header">Bachelor of Science in Engineering (e.g., Mechanical, Electrical)</h1>
                <div class="career-description">
                    <span>Description</span>
                    <p>Centers on designing, analyzing, and improving mechanical and electrical systems, with applications in industries like manufacturing, energy, and construction.</p>
                </div>
                <div class="career-expectation">
                    <span>Expectation</span>
                    <p>Expect rigorous training in math, physics, and technical labs. Engineering careers often involve problem-solving under pressure and working on-site for long hours, especially in project-based environments.</p>
                </div>
                <span class="career-salary">Expected Starting Salary: <p>₱20,000 - ₱25,000 per month.</p></span>
            </div>
            <div class="career-course">
                <h1 class="career-header">Bachelor of Science in Information Technology</h1>
                <div class="career-description">
                    <span>Description</span>
                    <p>Covers software development, data management, and network systems, preparing graduates for roles in IT support, programming, and systems analysis.</p>
                </div>
                <div class="career-expectation">
                    <span>Expectation</span>
                    <p>Expect fast-paced learning in a constantly evolving field. IT professionals should stay updated on the latest tech trends, often engaging in problem-solving and troubleshooting.</p>
                </div>
                <span class="career-salary">Expected Starting Salary: <p>₱18,000 - ₱22,000 per month.</p></span>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center text-uppercase" href="{{ route('ncae')}}">
    Main Menu
</a>
@endsection

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#stem').css('background-color', '#62B485');
    });

    function fillCareerInfo(strand) {
        $('#menu :button').css('background-color', '#247547');
        $('#' + strand.name).css('background-color', '#62B485');
        $('.career-wrapper').html(courseContent(strand.name));
        $('.career-wrapper').scrollTop(0);
    }

    function courseContent(strand)
    {
        var data = '';
        switch (strand) {
            case 'abm':
                data = "<div class='career-course'><h1 class='career-header'>Bachelor of Science in Accountancy</h1><div class='career-description'><span>Description</span><p>Emphasizes financial reporting, auditing, and taxation. Prepares students to become Certified Public Accountants (CPAs).</p></div><div class='career-expectatio'><span>Expectation</span><p>Expect an intensive program with heavy accounting and finance coursework. Passing the CPA board exams is challenging but highly rewarding. Attention to detail and ethical standards are essential.</p></div><span class='career-salary'>Expected Starting Salary: <p>₱15,000 - ₱20,000 per month.</p></span></div><div class='career-course'><h1 class='career-header'>Bachelor of Science in Business Administration</h1><div class='career-description'><span>Description</span><p>Focuses on business operations, management principles, and organizational behavior, preparing students for managerial roles in various sectors.</p></div><div class='career-expectatio'><span>Expectation</span><p>Expect a mix of theory and practical skills in leadership, finance, and decision-making. Strong communication and teamwork skills are essential as the field is collaborative and dynamic.</p></div><span class='career-salary'>Expected Starting Salary: <p>₱18,000 - ₱22,000 per month.</p></span></div><div class='career-course'><h1 class='career-header'>Bachelor of Science in Marketing</h1><div class='career-description'><span>Description</span><p>Covers market research, advertising, and consumer behavior, preparing graduates for careers in marketing, sales, and brand management.</p></div><div class='career-expectatio'><span>Expectation</span><p>Expect to develop analytical and creative skills. Marketing careers require adaptability and a keen sense of market trends, with a focus on understanding customer needs and building brand strategies.</p></div><span class='career-salary'>Expected Starting Salary: <p>₱16,000 - ₱20,000 per month.</p></span></div>";
                break;
            case 'humss':
                data = "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Arts in Psychology</h1>"+
                    "<div class='career-description'>"+
                        "<span>Description</span>"+
                        "<p>Studies human behavior, emotions, and mental processes, preparing students for roles in counseling, therapy, and social services.</p>"+
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect hands-on experience in psychology labs and clinics, as well as a deep understanding of psychological theories. Empathy, patience, and communication are key traits for success in psychology.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱15,000 - ₱19,000 per month.</p></span>" +
                "</div>" +
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Arts in Communication</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Focuses on media studies, journalism, and public relations, equipping students with skills for careers in media, corporate communications, and advertising.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect to develop strong writing, speaking, and analytical skills. The field demands creativity, critical thinking, and adaptability to various media formats and platforms.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱14,000 - ₱18,000 per month.</p></span>" +
                "</div>"
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Arts in Political Science</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Examines government systems, political behavior, and public policies, preparing graduates for careers in public service, law, and international relations.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect a challenging program involving policy analysis and legal studies. A strong interest in current events, governance, and social issues is essential for success in political science.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱15,000 - ₱20,000 per month.</p></span>" +
                "</div>";
                break;
            case 'gas':
                data = "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Science in Education</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Prepares students to become educators in primary and secondary schools, focusing on teaching methodologies and curriculum development.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect extensive practicum in classrooms, learning how to manage students and create lesson plans. Passion for teaching and patience with students are essential traits for educators.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱12,000 - ₱16,000 per month.</p></span>" +
                "</div>" +
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Science in Tourism</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Covers travel management, hospitality, and cultural studies, preparing students for roles in the tourism and hospitality industries.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect exposure to customer service skills, event planning, and cultural sensitivity. Jobs in this field often require flexibility and excellent interpersonal skills.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱15,000 - ₱19,000 per month.</p></span>" +
                "</div>" +
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Science in Environmental Science</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Studies environmental systems, conservation, and sustainability, preparing graduates for careers in environmental management and advocacy.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect fieldwork and research focused on sustainability and environmental issues. This field requires dedication to conservation efforts and advocacy for environmental protection.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱14,000 - ₱18,000 per month.</p></span>" +
                "</div>";
                break;
            case 'tvl':
                data = "<div class='career-course'>" +
                    "<h1 class='career-header'>Certificate in Culinary Arts</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Provides training in cooking techniques, food safety, and kitchen management, preparing students for roles in the culinary industry.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect a hands-on, intensive learning environment. Culinary work is fast-paced and requires creativity, discipline, and adaptability.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱12,000 - ₱15,000 per month.</p></span>" +
                "</div>" +
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Certificate in Automotive Servicing</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Focuses on vehicle maintenance, repair, and diagnostics, equipping students with skills to work in automotive service centers.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect practical experience working on various vehicles, along with knowledge of the latest diagnostic tools. Precision and technical skill are crucial in this field.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱13,000 - ₱16,000 per month.</p></span>" +
                "</div>" +
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Certificate in Electrical Installation and Maintenance</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Covers electrical systems, wiring, and safety protocols, preparing graduates for roles as electricians and electrical maintenance personnel.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect rigorous training in electrical work, focusing on safety and accuracy. Working as an electrician involves physical tasks and a strong understanding of safety regulations.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱14,000 - ₱17,000 per month.</p></span>" +
                "</div>";
                break;
            case 'stem':
                data = "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Science in Nursing</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Focuses on patient care, health promotion, and disease prevention. Prepares students for roles in hospitals, clinics, and community health settings.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect a challenging yet rewarding journey, with practical clinical experience in hospitals. Nursing often demands long shifts, emotional resilience, and a compassionate approach to patient care.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱15,000 - ₱20,000 per month.</p></span>" +
                "</div>" +
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Science in Engineering (e.g., Mechanical, Electrical)</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Centers on designing, analyzing, and improving mechanical and electrical systems, with applications in industries like manufacturing, energy, and construction.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect rigorous training in math, physics, and technical labs. Engineering careers often involve problem-solving under pressure and working on-site for long hours, especially in project-based environments.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱20,000 - ₱25,000 per month.</p></span>" +
                "</div>" +
                "<div class='career-course'>" +
                    "<h1 class='career-header'>Bachelor of Science in Information Technology</h1>" +
                    "<div class='career-description'>" +
                        "<span>Description</span>" +
                        "<p>Covers software development, data management, and network systems, preparing graduates for roles in IT support, programming, and systems analysis.</p>" +
                    "</div>" +
                    "<div class='career-expectatio'>" +
                        "<span>Expectation</span>" +
                        "<p>Expect fast-paced learning in a constantly evolving field. IT professionals should stay updated on the latest tech trends, often engaging in problem-solving and troubleshooting.</p>" +
                    "</div>" +
                    "<span class='career-salary'>Expected Starting Salary: <p>₱18,000 - ₱22,000 per month.</p></span>" +
                "</div>";
                break;
            default:
                data = "";
                break;
        }

        return data;
    }
</script>
@endsection