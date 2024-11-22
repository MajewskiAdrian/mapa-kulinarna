-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 22, 2024 at 01:37 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapa_kulinarna`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `administracja`
--

CREATE TABLE `administracja` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administracja`
--

INSERT INTO `administracja` (`id`, `username`, `pwd`) VALUES
(1, 'admin', '$2y$12$CsF4.HFnlj4rqwM8ruma6.RBMI6YWA34lznwN14OVjtOnXYGUDdNy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dania`
--

CREATE TABLE `dania` (
  `id` int(11) NOT NULL,
  `nazwa_dania` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `wegetarianskie` tinyint(1) NOT NULL,
  `kuchnia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dania`
--

INSERT INTO `dania` (`id`, `nazwa_dania`, `opis`, `wegetarianskie`, `kuchnia`) VALUES
(1, 'Makowiec', 'Tradycyjne polskie ciasto drożdżowe nadziewane masą makową, często z miodem, bakaliami i przyprawami. Jest to jeden z najważniejszych deserów świątecznych, zwłaszcza na Boże Narodzenie. Symbolizuje dostatek i pomyślność, a jego obecność na świątecznym stole to część polskiej tradycji.', 0, 'Polska'),
(2, 'Pierogi', 'Pierogi to ikona polskiej kuchni – ciasto wypełnione różnorodnymi farszami: od mięsa, przez ziemniaki, po owoce. Często podawane na różne okazje, w tym na Wigilię. Mogą być gotowane lub smażone, a także serwowane z dodatkami jak cebula czy śmietana. To danie uniwersalne, które można łatwo dostosować do różnych gustów.', 1, 'Polska'),
(3, 'Gołąbki', 'Gołąbki to liście kapusty, w które zawija się farsz z mięsa, ryżu i przypraw. Gotowane w sosie pomidorowym lub duszone, gołąbki są sycącym daniem, które podawane jest podczas uroczystości rodzinnych i świąt. To klasyczne danie polskiej kuchni, które jest cenione za swój aromat i pełnię smaku.', 0, 'Polska'),
(4, 'Sernik', 'Sernik to tradycyjny polski deser z twarogu, który może być przygotowywany na różne sposoby. Jest to ciasto o delikatnej konsystencji, często zdobione owocami, polewami lub czekoladą. Sernik jest niezwykle popularny w Polsce, zwłaszcza na święta, i stanowi jeden z najbardziej klasycznych deserów.', 1, 'Polska'),
(5, 'Golonka', 'Golonka to danie składające się z gotowanej lub pieczonej golonki wieprzowej, zazwyczaj podawanej z ziemniakami lub kapustą. Jest to bardzo sycące i aromatyczne danie, które cieszy się dużą popularnością w Polsce, zwłaszcza w tradycyjnych, regionalnych restauracjach.', 0, 'Polska'),
(6, 'Gulasz', 'Gulasz to jednogarnkowe danie mięsne, które składa się z mięsa (zwykle wołowego), warzyw i przypraw, gotowanych na wolnym ogniu. To sycące danie, które ma wiele regionalnych odmian w Polsce i innych krajach Europy Środkowej. Często podawane z kaszą, ziemniakami lub chlebem.', 0, 'Polska'),
(7, 'Szarlotka', 'Szarlotka to tradycyjny polski deser, który składa się z kruchego ciasta i nadzienia jabłkowego. Często przyprawiany cynamonem i cukrem, a także polany lukrem lub posypany cukrem pudrem. Jest to popularne danie w Polsce, zwłaszcza na jesień, gdy jabłka są w pełni sezonu.', 1, 'Polska'),
(8, 'Rosół', 'Rosół to klarowna zupa mięsna, przygotowywana zazwyczaj z kurczaka lub wołowiny, gotowana z warzywami. To danie, które jest symbolem polskiej kuchni i często podawane jest na rodzinnych obiadach lub podczas świąt. Uważane jest za lekcję zdrowia, idealne na rozgrzanie w zimne dni.', 0, 'Polska'),
(9, 'Kopytka', 'Kopytka to polskie kluski, które mają kształt małych prostokątów lub poduszeczek. Są one przygotowywane głównie z ziemniaków i mąki. Często podawane z różnymi sosami, takimi jak masło i cebula, ale także w wersji na słodko. Popularne w Polsce jako dodatek do mięsa, ale również jako danie główne.', 1, 'Polska'),
(10, 'Żurek', 'Żurek to tradycyjna polska zupa, której głównym składnikiem jest zakwas na bazie mąki żytniej. Zupa ma charakterystyczny kwaśny smak i jest podawana z białą kiełbasą, jajkiem i często ziemniakami. Jest to jedno z najbardziej charakterystycznych dań polskiej kuchni.', 0, 'Polska'),
(11, 'Bigos', 'Bigos to jednogarnkowe danie, które jest mieszanką kapusty, mięsa (często wieprzowego i wołowego) oraz przypraw. Potrawa jest duszona przez długi czas, co sprawia, że smaki się wzajemnie przenikają. Bigos to danie, które stało się symbolem polskich świąt i uroczystości.', 0, 'Polska'),
(12, 'Kotlet Schabowy', 'Kotlet schabowy to jedno z najbardziej popularnych dań w Polsce. Jest to panierowane mięso wieprzowe, smażone na złoto i często podawane z ziemniakami i kapustą lub surówką. Kotlet schabowy stanowi klasyczny obiad w polskich domach.', 0, 'Polska'),
(13, 'Zupa Pomidorowa', 'Zupa pomidorowa to klasyczna polska zupa przygotowywana z pomidorów, która może być gotowana na wywarze mięsnym lub warzywnym. Zupa jest często podawana z ryżem lub makaronem i stanowi ulubione danie w polskich domach.', 0, 'Polska'),
(14, 'Paszteciki', 'Paszteciki to małe, nadziewane ciastka, które mogą być wypełnione mięsem, kapustą, grzybami lub innymi farszami. Są one często podawane jako przekąska lub dodatek do zupy, zwłaszcza w okresie świątecznym.', 1, 'Polska'),
(15, 'Kremówka', 'Kremówka to tradycyjny polski deser składający się z dwóch warstw ciasta francuskiego, wypełnionych kremem budyniowym. Jest to delikatny, słodki wypiek, który zdobył popularność, szczególnie po wizycie papieża Jana Pawła II w Wadowicach.', 0, 'Polska'),
(16, 'Pizza Margherita', 'Pizza Margherita to jedna z najbardziej znanych i cenionych pizz na świecie, pochodząca z Neapolu. Składa się z cienkiego ciasta, pokrytego sosem pomidorowym, mozzarellą i świeżą bazylią, które nawiązuje do kolorów włoskiej flagi. Historia tej pizzy sięga 1889 roku, kiedy to królowa Margherita z Sabaudii odwiedziła Neapol, a szef kuchni Raffaele Esposito przygotował dla niej tę pizzę na cześć jej imienia. Choć pizza Margherita istniała już wcześniej, to właśnie wtedy zyskała swoją nazwę. Dziś pizza Margherita jest symbolem kuchni włoskiej i jest uznawana za jedną z najważniejszych potraw narodowych', 1, 'Włoska'),
(17, 'Risotto z grzybami', 'Risotto z grzybami to klasyczne włoskie danie, w którym kremowy ryż łączy się z intensywnym smakiem różnych gatunków grzybów, takich jak borowiki, shiitake czy pieczarki. Grzyby są smażone na maśle, a następnie dodawane do ryżu, który powoli wchłania bulion, tworząc gęstą i kremową konsystencję. Risotto jest zazwyczaj wykańczane parmezanem i świeżymi ziołami, a jego smak wzbogacają również cebula, czosnek i białe wino. To danie pełne aromatów, idealne na chłodniejsze dni, które wprowadza do kuchni włoskiej bogaty smak grzybów i ryżu. Risotto z grzybami to elegancka potrawa, która może być zarówno samodzielnym daniem, jak i dodatkiem do mięsnych potraw', 1, 'Włoska'),
(18, 'Spaghetti Bolognese', 'Spaghetti Bolognese to danie, które stało się popularne na całym świecie, choć w samej Bolognii jest znane głównie jako tagliatelle al ragù. Klasyczny włoski ragù, czyli sos mięsny, przygotowywany jest z mielonej wołowiny, wieprzowiny, pomidorów i aromatycznych przypraw. W wersji międzynarodowej często serwuje się go z makaronem spaghetti, mimo że tradycyjnie to inne rodzaje makaronu, takie jak tagliatelle, pasują lepiej do tego sosu. Bolognese to danie bogate w smaki, które stało się symbolem kuchni włoskiej poza granicami Włoch. To klasyczne połączenie mięsa, pomidorów i wina tworzy aromatyczny i pełen smaku sos, który podbija serca miłośników makaronu', 0, 'Włoska'),
(19, 'Carbonara', 'Carbonara to klasyczne rzymskie danie składające się z makaronu (zwykle spaghetti), guanciale (smażona bekonowa skórka), jajek, żółtek i sera Pecorino Romano. Choć to danie jest proste, łączy w sobie intensywne smaki, a jego przygotowanie wymaga precyzji, aby uzyskać kremową konsystencję bez jajecznicy. Istnieje wiele teorii na temat pochodzenia carbonary, jednak jedno jest pewne – jest to jedno z ulubionych dań kuchni włoskiej, cieszące się ogromną popularnością na całym świecie. Tradycyjnie przygotowywane w Rzymie, carbonara jest daniem pełnym smaku i doskonałym przykładem włoskiej prostoty i elegancji', 0, 'Włoska'),
(20, 'Ravioli z homarem', 'Ravioli z homarem to włoska potrawa, w której ciasto ravioli jest nadziewane mieszanką mięsa homara, jaj, pomidorów, bazylii, śmietany i białego wina. Danie to pochodzi z Włoch i jest szczególnie popularne w kuchni śródziemnomorskiej, łącząc delikatność homara z aromatycznymi składnikami. Ravioli są gotowane w bulionie z warzyw i skorupiaków, a następnie podawane z sosem na bazie masła, czosnku i świeżych ziół. To elegancka i wykwintna potrawa, idealna na specjalne okazje. Ravioli z homarem to połączenie wyrafinowanego smaku morza z tradycyjnymi włoskimi technikami przygotowywania makaronu', 0, 'Włoska'),
(21, 'Gnocchi alla Sorrentina', 'Gnocchi alla Sorrentina to tradycyjne danie z Kampanii, a dokładnie z Sorrento, składające się z delikatnych klusek ziemniaczanych zapiekanych w aromatycznym sosie pomidorowym z mozzarellą i bazylią. Gnocchi są pieczone w piekarniku, aż ser się rozpuści, a danie uzyska złocisty, chrupiący wierzch. To klasyczna potrawa, która idealnie nadaje się na letnie obiady, szczególnie gdy przygotowana jest z świeżych składników, takich jak mozzarella di bufala i sezonowe pomidory. Gnocchi alla Sorrentina to proste, ale pełne smaku danie, które zachwyca dzięki połączeniu ziemniaczanych gnocchi i intensywnego sosu pomidorowego', 1, 'Włoska'),
(22, 'Tiramisu', 'Tiramisu to jeden z najsłynniejszych włoskich deserów, który składa się z warstw biszkoptów nasączonych kawą, mascarpone, żółtkami i cukrem, a wszystko jest posypane kakao. Jego nazwa pochodzi od włoskiego tirami su, co oznacza podnieś mnie, nawiązując do pobudzającego działania kawy i alkoholu. Choć jego pochodzenie jest sporne, przypisuje się je regionowi Veneto, a deser zyskał ogromną popularność na całym świecie. Tiramisu jest kremowe, delikatne i idealne na zakończenie włoskiego posiłku. To deser, który łączy proste składniki w wyjątkowy sposób, tworząc niezapomniany smak', 1, 'Włoska'),
(23, 'Pizza Napoletana', 'Pizza Napoletana to klasyczna włoska pizza z Neapolu, uznawana za jedną z najbardziej autentycznych wersji tego dania. Charakteryzuje się cienkim, elastycznym ciastem, które jest pieczone w piecu opalanym drewnem, co nadaje jej niepowtarzalny smak. Tradycyjnie jest bardzo prosta, z minimalną ilością składników, ale jej jakość tkwi w prostocie i świeżości użytych produktów. Pizza Napoletana została wpisana na listę produktów o chronionej nazwie pochodzenia (STG), co zapewnia jej autentyczność. To danie stało się symbolem włoskiej kuchni, znane i cenione na całym świecie', 1, 'Włoska'),
(24, 'Bruschetta', 'Bruschetta to klasyczna włoska przystawka, składająca się z opieczonego chleba posmarowanego czosnkiem, oliwą z oliwek i posypanego solą. Najczęściej podawana z dodatkami, takimi jak świeże pomidory, bazylia i ser, tworzy prostą, ale pełną smaku przekąskę. Pochodzi z Toskanii i jest popularna na całym terytorium Włoch jako lekka przekąska lub przystawka przed głównym daniem. Bruschetta jest symbolem włoskiej kuchni, znana ze swojej prostoty i świeżości składników. Idealna na letnie dni, kiedy pomidory są w pełni sezonu', 1, 'Włoska'),
(25, 'Torrone', 'Torrone to tradycyjny włoski nugat, szczególnie popularny w okresie świątecznym. Składa się głównie z miodu, cukru, białek jaj i orzechów, takich jak migdały, orzechy włoskie lub pistacje. Jest znany z delikatnej tekstury, która może być twarda lub miękka w zależności od regionu. Torrone pochodzi z Włoch, gdzie jest szczególnie ceniony w regionie Piemontu i Sycylia. To słodki przysmak, który jest integralną częścią włoskiej tradycji kulinarnej, szczególnie podczas Bożego Narodzenia', 1, 'Włoska'),
(26, 'Panna cotta', 'Panna cotta to klasyczny włoski deser, który zyskał międzynarodową popularność dzięki swojej kremowej konsystencji i prostocie wykonania. Składa się głównie z kremu, cukru i żelatyny, które tworzą gładką, delikatną masę. Deser ten pochodzi z Piemontu i jest często podawany z owocami, karmelowym sosem lub czekoladą, co wzbogaca jego smak. Panna cotta jest uwielbiana za swoją uniwersalność i łatwość w przygotowaniu. To idealny deser na zakończenie włoskiego posiłku, który może być przygotowany na wiele różnych sposobów', 1, 'Włoska'),
(27, 'Focaccia', 'Focaccia to włoski chleb, który jest miękki, puszysty i aromatyczny, często przyprawiany oliwą z oliwek, solą oraz świeżymi ziołami, takimi jak rozmaryn. Pochodzi z Włoch, a jej historia sięga czasów starożytnych Rzymian. Focaccia może być podawana jako przekąska, dodatek do posiłków lub używana jako baza do kanapek. Często wzbogacana jest o różne dodatki, takie jak oliwki, cebula czy pomidory. To klasyczne danie, które odzwierciedla prostotę i jakość włoskiej kuchni', 0, 'Włoska'),
(28, 'Carpaccio', 'Carpaccio to włoska przystawka, która składa się z cienko pokrojonego, surowego mięsa, najczęściej wołowiny, podawanego na zimno z oliwą z oliwek, cytryną, parmezanem i rukolą. Danie zostało po raz pierwszy stworzone w Wenecji w latach 50-tych XX wieku przez szefa kuchni Giuseppe Cipriani. Carpaccio jest lekką i elegancką opcją na początek posiłku, idealnie komponującą się z winem. Można je również przygotować z ryb, takich jak tuńczyk czy łosoś, tworząc wersje różne od klasycznej wołowiny. To wyjątkowe danie, które podkreśla świeżość składników i smak surowego mięsa', 0, 'Włoska'),
(29, 'Cannoli', 'Cannoli to tradycyjny włoski deser, który pochodzi z Sycylii i jest jednym z najbardziej rozpoznawalnych słodkich przysmaków włoskich. Składa się z chrupiących rurek wypełnionych słodkim nadzieniem z ricotty, często z dodatkiem czekolady, owoców kandyzowanych lub orzechów. Cannoli mają kształt rurki, którą smaży się na głębokim oleju, a następnie napełnia kremową, delikatną masą. Deser ten jest szczególnie popularny podczas świąt i uroczystości rodzinnych. Cannoli to słodka, włoska klasyka, która zyskała międzynarodową popularność dzięki swojej wyjątkowej teksturze i bogatemu smakowi', 1, 'Włoska'),
(30, 'Lasagne alla Bolognese', 'Lasagne alla Bolognese to klasyczne danie z regionu Emilia-Romania, które składa się z warstw makaronu, bogatego ragù mięsnego (najczęściej z mielonej wołowiny i wieprzowiny), beszamelu i parmezanu. Danie to jest znane na całym świecie i uważane za symbol włoskiej kuchni. Wersja Bolognese różni się od innych, ponieważ ragù jest gotowane przez długi czas, co nadaje mu głęboki, intensywny smak. Lasagne jest pieczona w piekarniku, aż całość stanie się złocista i bąbelkująca. To sycące i aromatyczne danie, idealne na rodzinne obiady', 0, 'Włoska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dania_skladniki`
--

CREATE TABLE `dania_skladniki` (
  `id_dania` int(11) NOT NULL,
  `id_skladnika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dania_skladniki`
--

INSERT INTO `dania_skladniki` (`id_dania`, `id_skladnika`) VALUES
(1, 1),
(2, 1),
(3, 1),
(7, 1),
(9, 1),
(12, 1),
(14, 1),
(15, 1),
(16, 1),
(21, 1),
(23, 1),
(27, 1),
(29, 1),
(13, 2),
(16, 2),
(20, 2),
(23, 2),
(24, 2),
(16, 3),
(21, 3),
(23, 3),
(16, 4),
(20, 4),
(21, 4),
(23, 4),
(24, 4),
(27, 4),
(3, 5),
(17, 5),
(2, 6),
(17, 6),
(1, 7),
(4, 7),
(7, 7),
(14, 7),
(15, 7),
(17, 7),
(30, 7),
(2, 8),
(5, 8),
(6, 8),
(8, 8),
(11, 8),
(13, 8),
(14, 8),
(17, 8),
(5, 9),
(6, 9),
(8, 9),
(11, 9),
(13, 9),
(17, 9),
(24, 9),
(27, 9),
(17, 10),
(30, 10),
(18, 11),
(18, 12),
(2, 13),
(3, 13),
(14, 13),
(18, 13),
(18, 14),
(18, 15),
(18, 16),
(20, 17),
(8, 18),
(10, 18),
(13, 18),
(18, 18),
(19, 19),
(19, 20),
(19, 21),
(21, 21),
(1, 22),
(2, 22),
(4, 22),
(7, 22),
(9, 22),
(10, 22),
(12, 22),
(14, 22),
(15, 22),
(19, 22),
(20, 22),
(21, 22),
(22, 22),
(25, 22),
(3, 23),
(6, 23),
(12, 23),
(19, 23),
(21, 23),
(28, 23),
(20, 24),
(20, 25),
(3, 26),
(4, 26),
(10, 26),
(20, 26),
(26, 26),
(20, 27),
(23, 27),
(24, 27),
(27, 27),
(2, 28),
(9, 28),
(10, 28),
(11, 28),
(21, 28),
(21, 29),
(22, 30),
(23, 31),
(24, 31),
(1, 32),
(14, 32),
(23, 32),
(27, 32),
(3, 33),
(12, 33),
(13, 33),
(14, 33),
(15, 33),
(23, 33),
(27, 33),
(28, 33),
(24, 34),
(1, 35),
(4, 35),
(7, 35),
(14, 35),
(15, 35),
(22, 35),
(25, 35),
(26, 35),
(27, 35),
(29, 35),
(5, 36),
(25, 36),
(25, 37),
(4, 39),
(15, 39),
(25, 39),
(26, 39),
(25, 40),
(28, 40),
(26, 41),
(5, 42),
(27, 42),
(28, 42),
(6, 43),
(28, 44),
(28, 45),
(14, 46),
(15, 46),
(28, 46),
(29, 47),
(22, 48),
(29, 48),
(29, 49),
(29, 50),
(29, 51),
(29, 52),
(30, 53),
(30, 54),
(30, 55),
(1, 56),
(1, 57),
(2, 58),
(4, 58),
(5, 59),
(11, 59),
(12, 59),
(11, 60),
(3, 61),
(13, 61),
(5, 63),
(5, 64),
(5, 65),
(13, 65),
(6, 66),
(1, 67),
(8, 68),
(8, 69),
(8, 70),
(11, 70),
(8, 71),
(13, 71),
(8, 72),
(10, 74),
(11, 74),
(10, 75),
(12, 76),
(3, 78),
(15, 80),
(22, 81),
(22, 82),
(4, 83),
(7, 84),
(7, 85);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `dania_z_pomidorem`
-- (See below for the actual view)
--
CREATE TABLE `dania_z_pomidorem` (
`nazwa_dania` varchar(255)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `liczba_skladnikow_w_daniu`
-- (See below for the actual view)
--
CREATE TABLE `liczba_skladnikow_w_daniu` (
`nazwa_dania` varchar(255)
,`liczba_skladnikow` bigint(21)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `liczba_wystapien_skladnikow`
-- (See below for the actual view)
--
CREATE TABLE `liczba_wystapien_skladnikow` (
`nazwa_skladnika` varchar(50)
,`ilosc_wystapien` bigint(21)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `najczestsze_skladniki`
-- (See below for the actual view)
--
CREATE TABLE `najczestsze_skladniki` (
`restauracja` varchar(255)
,`nazwa_skladnika` varchar(50)
,`liczba_wystapien` bigint(21)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `potrawy_wegetarianskie`
-- (See below for the actual view)
--
CREATE TABLE `potrawy_wegetarianskie` (
`restauracja` varchar(255)
,`nazwa_dania` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restauracje`
--

CREATE TABLE `restauracje` (
  `id` int(11) NOT NULL,
  `nazwa_restauracji` varchar(255) NOT NULL,
  `panstwo` varchar(62) NOT NULL,
  `miasto` varchar(60) NOT NULL,
  `ulica` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restauracje`
--

INSERT INTO `restauracje` (`id`, `nazwa_restauracji`, `panstwo`, `miasto`, `ulica`) VALUES
(1, 'Senses', 'Polska', 'Warszawa', 'Bielańska 12'),
(2, 'Atelier Amaro', 'Polska', 'Warszawa', 'Agrykola 1'),
(3, 'Pod Aniołami', 'Polska', 'Kraków', 'Grodzka 35'),
(4, 'Osteria Francescana', 'Włochy', 'Modena', 'Via Stella 22'),
(5, 'La Pergola', 'Włochy', 'Rzym', 'Via Alberto Cadlolo 101'),
(6, 'Piazza Duomo', 'Włochy', 'Alba', 'Piazza Risorgimento 4');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restauracje_dania`
--

CREATE TABLE `restauracje_dania` (
  `id_restauracji` int(11) NOT NULL,
  `id_dania` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restauracje_dania`
--

INSERT INTO `restauracje_dania` (`id_restauracji`, `id_dania`) VALUES
(1, 1),
(1, 4),
(1, 5),
(1, 7),
(1, 10),
(2, 2),
(2, 3),
(2, 11),
(2, 14),
(2, 15),
(3, 6),
(3, 8),
(3, 9),
(3, 12),
(3, 13),
(4, 16),
(4, 19),
(4, 20),
(4, 28),
(4, 29),
(5, 17),
(5, 18),
(5, 25),
(5, 26),
(5, 30),
(6, 21),
(6, 22),
(6, 23),
(6, 24),
(6, 27);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `restauracje_z_daniami_z_pomidorem`
-- (See below for the actual view)
--
CREATE TABLE `restauracje_z_daniami_z_pomidorem` (
`nazwa_restauracji` varchar(255)
,`nazwa_dania` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skladniki`
--

CREATE TABLE `skladniki` (
  `id` int(11) NOT NULL,
  `nazwa_skladnika` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skladniki`
--

INSERT INTO `skladniki` (`id`, `nazwa_skladnika`) VALUES
(1, 'mąka'),
(2, 'pomidor'),
(3, 'mozzarella'),
(4, 'bazylia'),
(5, 'ryż'),
(6, 'grzyby'),
(7, 'masło'),
(8, 'cebula'),
(9, 'czosnek'),
(10, 'parmigiano reggiano'),
(11, 'tagliatelle'),
(12, 'mielona wołowina'),
(13, 'mielona wieprzowina'),
(14, 'pancetta'),
(15, 'pasta pomidorowa'),
(16, 'wino czerwone'),
(17, 'wino białe'),
(18, 'marchew'),
(19, 'spaghetti'),
(20, 'guanciale'),
(21, 'pecorino romano'),
(22, 'jajka'),
(23, 'czarny pieprz'),
(24, 'ravioli'),
(25, 'homar'),
(26, 'śmietana'),
(27, 'oliwa z oliwek'),
(28, 'ziemniaki'),
(29, 'sos pomidorowy'),
(30, 'biszkopty'),
(31, 'oregano'),
(32, 'drożdże'),
(33, 'sól'),
(34, 'chleb'),
(35, 'cukier'),
(36, 'miód'),
(37, 'migdały'),
(38, 'orzechy laskowe'),
(39, 'wanilia'),
(40, 'cytryna'),
(41, 'żelatyna'),
(42, 'rozmaryn'),
(43, 'wołowina'),
(44, 'majonez'),
(45, 'sos worcestershire'),
(46, 'mleko'),
(47, 'ricotta'),
(48, 'ziarna kakaowe'),
(49, 'kandyzowane owoce'),
(50, 'marsala'),
(51, 'ocet'),
(52, 'smalec'),
(53, 'lasagna'),
(54, 'sos boloński'),
(55, 'beszamel'),
(56, 'nasiona maku'),
(57, 'skórka cytrynowa'),
(58, 'twaróg'),
(59, 'wieprzowina'),
(60, 'kapusta kiszona'),
(61, 'przecier pomidorowy'),
(62, 'śmietana podwójna'),
(63, 'piwo'),
(64, 'musztarda'),
(65, 'tymianek'),
(66, 'papryka'),
(67, 'proszek do pieczenia'),
(68, 'kurczak'),
(69, 'makaron'),
(70, 'liście laurowe'),
(71, 'pietruszka'),
(72, 'seler'),
(73, 'bekon'),
(74, 'kielbasa'),
(75, 'mąka żytnia'),
(76, 'bułka tarta'),
(77, 'olej rzepakowy'),
(78, 'bulion'),
(79, 'ocet balsamiczny'),
(80, 'skrobia kukurydziana'),
(81, 'mascarpone'),
(82, 'kawa'),
(83, 'mąka ziemniaczana'),
(84, 'jabłka'),
(85, 'cynamon');

-- --------------------------------------------------------

--
-- Struktura widoku `dania_z_pomidorem`
--
DROP TABLE IF EXISTS `dania_z_pomidorem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dania_z_pomidorem`  AS SELECT `d`.`nazwa_dania` AS `nazwa_dania` FROM ((`skladniki` `s` join `dania_skladniki` `ds` on(`s`.`id` = `ds`.`id_skladnika`)) join `dania` `d` on(`d`.`id` = `ds`.`id_dania`)) WHERE `s`.`nazwa_skladnika` = 'pomidor' ;

-- --------------------------------------------------------

--
-- Struktura widoku `liczba_skladnikow_w_daniu`
--
DROP TABLE IF EXISTS `liczba_skladnikow_w_daniu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `liczba_skladnikow_w_daniu`  AS SELECT `d`.`nazwa_dania` AS `nazwa_dania`, count(`ds`.`id_skladnika`) AS `liczba_skladnikow` FROM (`dania` `d` join `dania_skladniki` `ds` on(`d`.`id` = `ds`.`id_dania`)) GROUP BY `d`.`id`, `d`.`nazwa_dania` ;

-- --------------------------------------------------------

--
-- Struktura widoku `liczba_wystapien_skladnikow`
--
DROP TABLE IF EXISTS `liczba_wystapien_skladnikow`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `liczba_wystapien_skladnikow`  AS SELECT `s`.`nazwa_skladnika` AS `nazwa_skladnika`, count(`ds`.`id_skladnika`) AS `ilosc_wystapien` FROM (`skladniki` `s` join `dania_skladniki` `ds` on(`s`.`id` = `ds`.`id_skladnika`)) GROUP BY `s`.`id`, `s`.`nazwa_skladnika` ORDER BY count(`ds`.`id_skladnika`) DESC ;

-- --------------------------------------------------------

--
-- Struktura widoku `najczestsze_skladniki`
--
DROP TABLE IF EXISTS `najczestsze_skladniki`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `najczestsze_skladniki` AS 
WITH temp AS (
    SELECT 
        `r`.`id` AS `id`, 
        `r`.`nazwa_restauracji` AS `nazwa_restauracji`, 
        `s`.`nazwa_skladnika` AS `nazwa_skladnika`, 
        COUNT(`s`.`id`) AS `liczba_wystapien`, 
        ROW_NUMBER() OVER (
            PARTITION BY `r`.`nazwa_restauracji` 
            ORDER BY COUNT(`s`.`id`) DESC
        ) AS `ranking` 
    FROM 
        `restauracje` `r` 
        JOIN `restauracje_dania` `rd` ON (`r`.`id` = `rd`.`id_restauracji`)
        JOIN `dania_skladniki` `ds` ON (`rd`.`id_dania` = `ds`.`id_dania`)
        JOIN `skladniki` `s` ON (`ds`.`id_skladnika` = `s`.`id`)
    GROUP BY 
        `r`.`nazwa_restauracji`, 
        `s`.`nazwa_skladnika`
)
SELECT 
    `temp`.`nazwa_restauracji` AS `restauracja`, 
    `temp`.`nazwa_skladnika` AS `nazwa_skladnika`, 
    `temp`.`liczba_wystapien` AS `liczba_wystapien`
FROM 
    `temp`
WHERE 
    `temp`.`ranking` = 1
ORDER BY 
    `temp`.`id` ASC;

-- --------------------------------------------------------

--
-- Struktura widoku `potrawy_wegetarianskie`
--
DROP TABLE IF EXISTS `potrawy_wegetarianskie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `potrawy_wegetarianskie`  AS SELECT `r`.`nazwa_restauracji` AS `restauracja`, `d`.`nazwa_dania` AS `nazwa_dania` FROM ((`restauracje` `r` join `restauracje_dania` `rd` on(`r`.`id` = `rd`.`id_restauracji`)) join `dania` `d` on(`rd`.`id_dania` = `d`.`id`)) WHERE `d`.`wegetarianskie` = 1 ;

-- --------------------------------------------------------

--
-- Struktura widoku `restauracje_z_daniami_z_pomidorem`
--
DROP TABLE IF EXISTS `restauracje_z_daniami_z_pomidorem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `restauracje_z_daniami_z_pomidorem`  AS SELECT `r`.`nazwa_restauracji` AS `nazwa_restauracji`, `d`.`nazwa_dania` AS `nazwa_dania` FROM ((((`restauracje` `r` join `restauracje_dania` `rd` on(`r`.`id` = `rd`.`id_restauracji`)) join `dania_skladniki` `ds` on(`rd`.`id_dania` = `ds`.`id_dania`)) join `skladniki` `s` on(`s`.`id` = `ds`.`id_skladnika`)) join `dania` `d` on(`d`.`id` = `ds`.`id_dania`)) WHERE `s`.`nazwa_skladnika` = 'pomidor' ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `administracja`
--
ALTER TABLE `administracja`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `dania`
--
ALTER TABLE `dania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `dania_skladniki`
--
ALTER TABLE `dania_skladniki`
  ADD PRIMARY KEY (`id_skladnika`,`id_dania`),
  ADD KEY `id_dania` (`id_dania`);

--
-- Indeksy dla tabeli `restauracje`
--
ALTER TABLE `restauracje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `restauracje_dania`
--
ALTER TABLE `restauracje_dania`
  ADD PRIMARY KEY (`id_restauracji`,`id_dania`),
  ADD KEY `id_dania` (`id_dania`);

--
-- Indeksy dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administracja`
--
ALTER TABLE `administracja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dania`
--
ALTER TABLE `dania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `restauracje`
--
ALTER TABLE `restauracje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skladniki`
--
ALTER TABLE `skladniki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dania_skladniki`
--
ALTER TABLE `dania_skladniki`
  ADD CONSTRAINT `dania_skladniki_ibfk_1` FOREIGN KEY (`id_skladnika`) REFERENCES `skladniki` (`id`),
  ADD CONSTRAINT `dania_skladniki_ibfk_2` FOREIGN KEY (`id_dania`) REFERENCES `dania` (`id`);

--
-- Constraints for table `restauracje_dania`
--
ALTER TABLE `restauracje_dania`
  ADD CONSTRAINT `restauracje_dania_ibfk_1` FOREIGN KEY (`id_restauracji`) REFERENCES `restauracje` (`id`),
  ADD CONSTRAINT `restauracje_dania_ibfk_2` FOREIGN KEY (`id_dania`) REFERENCES `dania` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
