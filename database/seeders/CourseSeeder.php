<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                [
                    'title' => 'معسكر تدريب تطوير الويب للمبتدئين',
                    'description' => 'في هذا المعسكر، ستتعلم أساسيات تطوير الويب بشكل شامل. سيتم تناول موضوعات مثل HTML، CSS، وJavaScript بطريقة مبسطة. ستساعدك الدروس العملية في فهم كيفية بناء المواقع الإلكترونية من الصفر.',
                    'instructor_id' => 1,
                    'level' => 'مبتدئ',
                    'price' => 300,
                    'duration' => 120,
                    'image' => 'https://th.bing.com/th/id/OIP.EdAbu4kAKRt2TWparEa4AAHaFq?rs=1&pid=ImgDetMain',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'تقنيات تطوير الويب المتوسطة',
                    'description' => 'هذا البرنامج مصمم لتعزيز مهاراتك في تطوير الويب من خلال تقنيات متوسطة مثل استخدام مكتبات JavaScript مثل React وVue.js. سيتضمن التطبيق العملي مشاريع حقيقية لتعزيز فهمك.',
                    'instructor_id' => 1,
                    'level' => 'متوسط',
                    'price' => 400,
                    'duration' => 180,
                    'image' => 'https://th.bing.com/th/id/R.5d8504e043c8d9596b66b21db8f50446?rik=dWd856g85xHnCw&pid=ImgRaw&r=0',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'أفضل ممارسات تطوير الويب المتقدمة',
                    'description' => 'سيساعدك هذا الكورس على إتقان أفضل الممارسات في تطوير الويب. ستتعلم كيفية تصميم مواقع سريعة وآمنة وقابلة للتوسع. يتضمن البرنامج مشاريع عملية واختبارات للتأكد من استيعابك.',
                    'instructor_id' => 3,
                    'level' => 'متقدم',
                    'price' => 550,
                    'duration' => 240,
                    'image' => 'https://th.bing.com/th/id/OIP.jBU0Zls2r0CY_T1U1gsiXQHaFF?w=860&h=591&rs=1&pid=ImgDetMain',
                    'subscription_plan_id' => 2,
                ],
                // Data Science
                [
                    'title' => 'أسس علم البيانات للمبتدئين',
                    'description' => 'تعلم أساسيات علم البيانات وكيفية تحليل البيانات بطرق مبسطة. ستركز على المفاهيم الأساسية وأدوات مثل Excel وPython لتحليل البيانات بطريقة سهلة وفعالة.',
                    'instructor_id' => 2,
                    'level' => 'مبتدئ',
                    'price' => 320,
                    'duration' => 150,
                    'image' => 'https://th.bing.com/th/id/OIP.VuniQ1tEaHZbVRWN0NuHIAHaEO?rs=1&pid=ImgDetMain',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'علم البيانات المتوسط باستخدام بايثون',
                    'description' => 'قم بتطوير مهاراتك في علم البيانات باستخدام بايثون. سيتناول هذا الكورس تقنيات التحليل المتقدمة وكيفية استخدام المكتبات الشهيرة مثل Pandas وNumPy.',
                    'instructor_id' => 2,
                    'level' => 'متوسط',
                    'price' => 420,
                    'duration' => 200,
                    'image' => 'https://th.bing.com/th/id/OIP.B4bq4YF8oZv3dKwOO2Td7QHaEM?w=1024&h=580&rs=1&pid=ImgDetMain',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'تقنيات علم البيانات المتقدمة',
                    'description' => 'استكشف التقنيات المتقدمة في علم البيانات مثل التعلم الآلي. سيتضمن الكورس مشاريع تطبيقية لمساعدتك في فهم كيفية استخدام البيانات لاتخاذ القرارات.',
                    'instructor_id' => 3,
                    'level' => 'متقدم',
                    'price' => 600,
                    'duration' => 220,
                    'image' => 'https://th.bing.com/th/id/OIP.B4bq4YF8oZv3dKwOO2Td7QHaEM?w=1024&h=580&rs=1&pid=ImgDetMain',
                    'subscription_plan_id' => 2,
                ],
                // Artificial Intelligence
                [
                    'title' => 'أساسيات الذكاء الاصطناعي للمبتدئين',
                    'description' => 'فهم أساسيات الذكاء الاصطناعي وكيفية تطبيقه في مجالات متنوعة. يتناول الكورس التعريفات الأساسية، والتقنيات المستخدمة، وكيفية بناء نماذج بسيطة.',
                    'instructor_id' => 4,
                    'level' => 'مبتدئ',
                    'price' => 330,
                    'duration' => 130,
                    'image' => 'https://th.bing.com/th/id/R.778b8d7e5b7a907ba3e8a561fd641d4e?rik=qeDatyxFzFaYhw&pid=ImgRaw&r=0',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'تطبيقات الذكاء الاصطناعي المتوسطة',
                    'description' => 'تعلم كيفية تطبيق مفاهيم الذكاء الاصطناعي في السيناريوهات الواقعية. سيتناول الكورس كيفية بناء نماذج ذكية وكيفية تحسين الأداء.',
                    'instructor_id' => 4,
                    'level' => 'متوسط',
                    'price' => 440,
                    'duration' => 190,
                    'image' => 'https://th.bing.com/th/id/OIP.vTWc30NN8QFFYgbxrQ3mdQHaEM?rs=1&pid=ImgDetMain',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'أنظمة الذكاء الاصطناعي المتقدمة',
                    'description' => 'تعمق في أنظمة الذكاء الاصطناعي المتقدمة وتعلم كيفية بناء الأنظمة القابلة للتكيف. سيتضمن الكورس مشاريع عملية وفهم شامل للمفاهيم.',
                    'instructor_id' => 5,
                    'level' => 'متقدم',
                    'price' => 650,
                    'duration' => 240,
                    'image' => 'https://educounsellors.com/wp-content/uploads/2023/07/Artificial-Intelligence-Course-730x411.png',
                    'subscription_plan_id' => 2,
                ],
                // Machine Learning
                [
                    'title' => 'مفاهيم تعلم الآلة للمبتدئين',
                    'description' => 'تعلم أساسيات تعلم الآلة وكيفية استخدامها لتحليل البيانات. سيتضمن البرنامج التعرف على الخوارزميات الأساسية وكيفية اختيار النموذج المناسب.',
                    'instructor_id' => 1,
                    'level' => 'مبتدئ',
                    'price' => 310,
                    'duration' => 140,
                    'image' => 'https://th.bing.com/th/id/OIP.x7x00uSQKqQKlu3VpAnAOgHaEK?rs=1&pid=ImgDetMain',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'تعلم الآلة المتوسطة باستخدام R',
                    'description' => 'تطوير مهارات تعلم الآلة باستخدام لغة R. سيتناول الكورس تقنيات تحليل البيانات المتقدمة وكيفية بناء نماذج التعلم الآلي.',
                    'instructor_id' => 2,
                    'level' => 'متوسط',
                    'price' => 450,
                    'duration' => 210,
                    'image' => 'https://s3.amazonaws.com/coursesity-blog/2020/07/Machine-Learning.png',
                    'subscription_plan_id' => 1,
                ],
                [
                    'title' => 'تقنيات تعلم الآلة المتقدمة',
                    'description' => 'استكشف تقنيات تعلم الآلة المتقدمة مثل الشبكات العصبية. سيتضمن الكورس مشاريع عملية لتعزيز فهمك وتطبيق مهاراتك.',
                    'instructor_id' => 5,
                    'level' => 'متقدم',
                    'price' => 670,
                    'duration' => 230,
                    'image' => 'https://th.bing.com/th/id/R.62171579eeb9ced71f585397b7b28f75?rik=Qf6BokkM1cfJVg&pid=ImgRaw&r=0',
                    'subscription_plan_id' => 2,
                ],
            ],
            // تطوير الألعاب
            [
                'title' => 'أساسيات تطوير الألعاب للمبتدئين',
                'description' => 'تعلم أساسيات تطوير الألعاب وكيفية إنشاء الألعاب البسيطة. ستتعرف على الأدوات والتقنيات اللازمة لتطوير ألعاب ناجحة.',
                'instructor_id' => 1,
                'level' => 'مبتدئ',
                'price' => 350,
                'duration' => 150,
                'image' => 'https://th.bing.com/th/id/OIP.Wjb5RWUuUw1s2LgEFnCBoQHaEK?rs=1&pid=ImgDetMain',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'تقنيات تطوير الألعاب المتوسطة',
                'description' => 'استكشاف تقنيات تطوير الألعاب المتوسطة وتحليل الألعاب المعقدة. ستتعلم كيفية استخدام محركات الألعاب المختلفة.',
                'instructor_id' => 2,
                'level' => 'متوسط',
                'price' => 400,
                'duration' => 180,
                'image' => 'https://techrevolve.com/wp-content/uploads/2020/03/Game-Development.png',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'استراتيجيات تطوير الألعاب المتقدمة',
                'description' => 'تعلم استراتيجيات متقدمة في تطوير الألعاب وكيفية تحسين تجربة المستخدم. سنغطي موضوعات مثل تصميم المستويات والتفاعل.',
                'instructor_id' => 3,
                'level' => 'متقدم',
                'price' => 650,
                'duration' => 300,
                'image' => 'https://www.geeky-gadgets.com/wp-content/uploads/2024/07/fine-tuning-AI-LLM-with-no-code-1024x610.jpg',
                'subscription_plan_id' => 2,
            ],
// تطوير التطبيقات المحمولة
            [
                'title' => 'مبتدئ أساسيات تطوير التطبيقات المحمولة',
                'description' => 'تعلم أساسيات تطوير التطبيقات المحمولة وكيفية بناء تطبيقات سهلة الاستخدام. ستتضمن الدورة تطبيقات عملية.',
                'instructor_id' => 1,
                'level' => 'مبتدئ',
                'price' => 320,
                'duration' => 130,
                'image' => 'https://www.geeky-gadgets.com/wp-content/uploads/2024/07/fine-tuning-AI-LLM-with-no-code-1024x610.jpg',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'متوسط تطوير تطبيقات المحمول',
                'description' => 'غص في عمق تطوير تطبيقات المحمول واستكشاف الأدوات والتقنيات المستخدمة في إنشاء التطبيقات الفعالة.',
                'instructor_id' => 2,
                'level' => 'متوسط',
                'price' => 380,
                'duration' => 170,
                'image' => 'https://www.geeky-gadgets.com/wp-content/uploads/2024/07/fine-tuning-AI-LLM-with-no-code-1024x610.jpg',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'متقدم تقنيات تطوير التطبيقات المحمولة',
                'description' => 'أتقن تقنيات تطوير التطبيقات المحمولة المتقدمة وكيفية تحسين الأداء وزيادة سرعة التطبيق.',
                'instructor_id' => 3,
                'level' => 'متقدم',
                'price' => 700,
                'duration' => 250,
                'image' => 'https://www.geeky-gadgets.com/wp-content/uploads/2024/07/fine-tuning-AI-LLM-with-no-code-1024x610.jpg',
                'subscription_plan_id' => 2,
            ],
// اختبار البرمجيات
            [
                'title' => 'مبتدئ أساسيات اختبار البرمجيات',
                'description' => 'تعلم أساسيات اختبار البرمجيات وأهمية ضمان جودة المنتج قبل الإطلاق. ستشمل الدورة تطبيقات عملية.',
                'instructor_id' => 1,
                'level' => 'مبتدئ',
                'price' => 280,
                'duration' => 120,
                'image' => 'https://th.bing.com/th/id/OIP.MAAX3OfhAUUw-UDb_jU4SgHaEK?rs=1&pid=ImgDetMain',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'متوسط تقنيات اختبار البرمجيات',
                'description' => 'استكشف التقنيات المتوسطة في اختبار البرمجيات وكيفية تنفيذ اختبارات فعالة لتحسين الجودة.',
                'instructor_id' => 2,
                'level' => 'متوسط',
                'price' => 400,
                'duration' => 180,
                'image' => 'https://th.bing.com/th/id/OIP.MAAX3OfhAUUw-UDb_jU4SgHaEK?rs=1&pid=ImgDetMain',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'متقدم استراتيجيات اختبار البرمجيات',
                'description' => 'أتقن استراتيجيات اختبار البرمجيات المتقدمة وكيفية تحليل النتائج لتحسين التطبيقات.',
                'instructor_id' => 3,
                'level' => 'متقدم',
                'price' => 650,
                'duration' => 240,
                'image' => 'https://th.bing.com/th/id/OIP.MAAX3OfhAUUw-UDb_jU4SgHaEK?rs=1&pid=ImgDetMain',
                'subscription_plan_id' => 2,
            ],
// الرياضيات
            [
                'title' => 'دورة الرياضيات للمبتدئين',
                'description' => 'تعلم أساسيات الرياضيات وكيفية تطبيقها في الحياة اليومية. الدورة مصممة للمبتدئين.',
                'instructor_id' => 1,
                'level' => 'مبتدئ',
                'price' => 300,
                'duration' => 120,
                'image' => 'https://th.bing.com/th/id/R.8ab4275fb7f989d0e0999e7b760f8f57?rik=UYaWOX2bMt9s4A&pid=ImgRaw&r=0',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'دورة الرياضيات المتوسطة',
                'description' => 'استكشاف المفاهيم الرياضية المتوسطة وكيفية استخدامها في حل المشاكل المختلفة. دورة تفاعلية.',
                'instructor_id' => 2,
                'level' => 'متوسط',
                'price' => 400,
                'duration' => 180,
                'image' => 'https://th.bing.com/th/id/R.3200dac264e24ea3a7eed973e8a27e8d?rik=J3mlDb%2bG6OQFyg&riu=http%3a%2f%2fstartupcollege.com.ng%2fwp-content%2fuploads%2f2018%2f04%2fmathematics-image.jpg&ehk=F7RUtOI7VmWyjeTGzfCsDg5Y%2bYRInxjaifgnJUBbmoA%3d&risl=&pid=ImgRaw&r=0',
                'subscription_plan_id' => 1,
            ],
            [
                'title' => 'دورة الرياضيات المتقدمة',
                'description' => 'تعلم الرياضيات المتقدمة وكيفية استخدامها في تطبيقات عملية. الدورة موجهة للطلاب المتقدمين.',
                'instructor_id' => 3,
                'level' => 'متقدم',
                'price' => 600,
                'duration' => 240,
                'image' => 'https://th.bing.com/th/id/R.3200dac264e24ea3a7eed973e8a27e8d?rik=J3mlDb%2bG6OQFyg&riu=http%3a%2f%2fstartupcollege.com.ng%2fwp-content%2fuploads%2f2018%2f04%2fmathematics-image.jpg&ehk=F7RUtOI7VmWyjeTGzfCsDg5Y%2bYRInxjaifgnJUBbmoA%3d&risl=&pid=ImgRaw&r=0',
                'subscription_plan_id' => 2,
            ],

        ];

        // Now, create the courses in the database
        foreach ($courses as $course) {
            \App\Models\Course::create($course);
        }

    }
}
