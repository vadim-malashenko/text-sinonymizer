<?php

namespace Profile\Text\Sinonymizer\Test;

use \PHPUnit\Framework\TestCase;
use Profile\Text\Sinonymizer\Filter\ProperNounsFilter;
use Profile\Text\Sinonymizer\Filter\QuotationMarksFilter;
use Profile\Text\Sinonymizer\Filter\TagsFilter;
use \Profile\Text\Sinonymizer\TranslatorSinonymizer;

class TranslatorSinonymizerTest extends TestCase
{
    public const LANGUAGES = ['ru', 'en'];

    public const EXCLUDES = [
        "#(«[^»]+»)|('[^']+')|(\"[^\"]+\")#u",
        "#(?<=([^.!?\s]\s))[A-ZЁА-Я][^\s.!?]+(?=(\s|\W))#u"
    ];

    public function setLanguagesProvider()
    {
        return [
            [
                ['ru', 'en'],
                [['ru', 'en'], ['en', 'ru']]
            ],
            [
                ['ru', 'en', 'fr'],
                [['ru', 'en'], ['en', 'fr'], ['fr', 'ru']]
            ],
            [
                ['ru', 'ru', 'en', 'en', 'fr'],
                [['ru', 'en'], ['en', 'fr'], ['fr', 'ru']]
            ]
        ];
    }

    public function sinonymizeProvider()
    {
        return [
            [
'Стало известно о планах Трасс занять «пост премьера» Британии за счет темы России. Стало известно о состоянии первого в России пациента с оспой обезьян.

Глава МИД ФРГ раскритиковала Эрдогана за фото с Путиным. Результаты второго тура парламентских выборов во Франции снизят "дееспособность этого государства" навсегда.',
'Стало известно о планах треков, чтобы занять «пост премьер -министра» за счет темы России. Это стало известно о состоянии первого пациента с оспой в России.

Министр иностранных дел FRG раскритиковал Эрдогана за фотографии с Путином. Результаты второго раунда парламентских выборов во Франции навсегда сократят «правовые возможности этого государства».',
                null
            ],
            [
<<<TOO_LONG_TEXT
Результаты второго тура парламентских выборов во Франции снизят дееспособность этого государства. И это плохая новость для Москвы, справедливо считающей Париж наиболее адекватным партнером во всей Европе. Но если нас интересует судьба демократической формы политического устройства как таковая, то итоги голосования во Франции – новость хорошая. Напомним, что в минувшее воскресенье, 19 июня, партия недавно переизбранного президентом Эммануэля Макрона «Вместе!» получила 245 мест, а радикальная оппозиция – «Новый народный экологический и социальный союз» Жан-Люка Меланшона и Национальное объединение Марин Ле Пен – 131 и 89 мест соответственно. Таким образом, Макрон потерял абсолютное большинство в парламенте, позволявшее формировать правительство, и теперь политическая система Франции погрузится в состояние, близкое к хаосу. Две крупнейшие оппозиционные силы придерживаются противоположных взглядов на практически все стоящие перед страной задачи, но в совершенно одинаковой мере настроены на борьбу со сторонниками президента. Эта борьба обещает быть непримиримой и разрушительной для французской государственности. То, что только получивший с таким трудом президентские полномочия на второй срок Эммануэль Макрон становится на ближайшие годы «хромой уткой», безусловно, не придаст Франции энергии на международной арене. Он, конечно, продолжит телефонные переговоры с Москвой и даже будет периодически призывать киевский режим начать диалог о мире. Однако если такие телодвижения и раньше были малорезультативными, то теперь все станет еще сложнее из-за неспособности Макрона что-то делать внутри страны. Основная энергия Елисейского дворца в оставшиеся пять лет будет тратиться на выживание, а тут не до большой политики. Да и в целом провал правящей партии на выборах ясно показывает, что развитие Пятой республики зашло в тупик. Это для России, конечно, немного дискомфортно и заставляет пожалеть о судьбе такого партнера. Франция до последнего времени оставалась страной, сохранившей сравнительно цивилизованные представления о природе международной политики. Если голос Парижа станет совсем не слышен на фоне взвизгиваний, раздающихся из Лондона и восточноевропейских столиц, и невнятного мычания Берлина, атмосфера в Европе станет совсем тягостной и говорить там будет не с кем. Но одновременно необходимо признать: Старый Свет и так находится в глубоком кризисе. И на фоне ожидаемых в ближайшее время потрясений частные французские проблемы – не самая большая беда. Макрон в любом случае, сколько бы он ни старался, не мог ничего изменить в течении хода истории, заданного ошибками, совершенными на волне эйфории от завершения холодной войны. Тем более что за коллапсом Пятой республики, к чему дело неуклонно двигается, может наступить возрождение французской государственности в новом виде. И в этом отношении прошедшие выборы даже вселяют некоторый оптимизм. Французское общество показало, что оно еще не погрузилось в полную апатию, для чего, казалось бы, созданы все условия. Размежевание предпочтений избирателей – это прекрасный показатель того, что легенда о неизбежной кастрации политических систем в демократических государствах – доминировании размытого «центра», всасывающего в себя всю повестку, и исчезновении радикализма – так и останется несбыточной мечтой элиты и бюрократии. Буквально несколько лет назад всем казалось, что политический радикализм в старых европейских демократиях уходит в прошлое. Само по себе появление макроновского движения «Вперед!» в 2016-м было сознательно нацелено на разрушение «старых» партий ради создания аморфного объединения, цель которого – любым способом сохранить контроль в руках элиты и чиновников. Для этого народу были обещаны реформы, которые так и не состоялись, поскольку за ними не стояло ни одной идеологически целостной концепции. Эксперимент можно считать завершенным, и радикализм по полной вернулся в политическую жизнь второй по размерам населения европейской державы. Выиграли французские избиратели, стряхнувшие с себя удавку всеядного центризма. Проиграла вся правящая верхушка, жаждущая власти ради власти. В том случае, если за неизбежно надвигающимся коллапсом последует некое новое начало, мы еще сможем увидеть возрожденную Францию. Тем более что цена, которую ей придется заплатить – распад Европейского союза и выход из НАТО, – с российской точки зрения является наиболее благоприятной для мира на континенте опцией.
TOO_LONG_TEXT,
                null,
                \InvalidArgumentException::class
            ]
        ];
    }

    /**
     * @dataProvider sinonymizeProvider
     * @param string $text
     * @param ?string $expected
     * @param ?string $exception
     */
    public function testSinonymize(string $text, ?string $expected, ?string $exception)
    {
        $sinonymizer = TranslatorSinonymizer::create(static::LANGUAGES);

        if (null === $exception) {
            $this->assertEquals($expected, $sinonymizer->sinonymize($text));
        }
        else {
            $this->expectException($exception);
            $sinonymizer->sinonymize($text);
        }
    }
}