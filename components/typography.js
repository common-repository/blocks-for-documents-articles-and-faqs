/** 
 * Typography component 
 * Use example: 
 * <Typography 
 * 	optionsLabel = 'name-of-the-props-item'
 *		{ ...this.props } // required
 * />
 * use getTypographyStyles() to show select with settings
 */

import generate_block_css from "../helpers/generate_block_css";

const { __ } = wp.i18n;
const {
	RangeControl,
	ButtonGroup,
	Button,
	Dashicon,
	SelectControl,
	Popover
} = wp.components;
const { Component, Fragment } = wp.element;

const gfonts = [
	"Roboto",
	"Open Sans",
	"Lato",
	"Noto Sans JP",
	"Montserrat",
	"Roboto Condensed",
	"Source Sans Pro",
	"Oswald",
	"Raleway",
	"Roboto Mono",
	"Poppins",
	"Noto Sans",
	"Roboto Slab",
	"Merriweather",
	"Ubuntu",
	"PT Sans",
	"Playfair Display",
	"Nunito",
	"Lora",
	"PT Serif",
	"Mukta",
	"Noto Sans KR",
	"Work Sans",
	"Rubik",
	"Fira Sans",
	"Noto Serif",
	"Nanum Gothic",
	"Titillium Web",
	"Nunito Sans",
	"Noto Sans TC",
	"Quicksand",
	"Hind Siliguri",
	"Heebo",
	"Yanone Kaffeesatz",
	"Oxygen",
	"Anton",
	"PT Sans Narrow",
	"Inconsolata",
	"Barlow",
	"Arimo",
	"Dosis",
	"Bebas Neue",
	"Libre Baskerville",
	"Crimson Text",
	"Slabo 27px",
	"Karla",
	"Josefin Sans",
	"Cabin",
	"Lobster",
	"Bitter",
	"Libre Franklin",
	"Source Code Pro",
	"Hind",
	"Fjalla One",
	"Dancing Script",
	"Abel",
	"Overpass",
	"Varela Round",
	"Indie Flower",
	"Source Serif Pro",
	"Pacifico",
	"Cairo",
	"Kanit",
	"Arvo",
	"Exo 2",
	"IBM Plex Sans",
	"Noto Sans SC",
	"Staatliches",
	"Merriweather Sans",
	"Barlow Condensed",
	"Shadows Into Light",
	"Archivo Narrow",
	"Hind Madurai",
	"Comfortaa",
	"Asap",
	"Questrial",
	"IBM Plex Serif",
	"Abril Fatface",
	"Permanent Marker",
	"EB Garamond",
	"Prompt",
	"Zilla Slab",
	"Fredoka One",
	"Noto Sans HK",
	"Catamaran",
	"Acme",
	"Play",
	"Bree Serif",
	"Monda",
	"Amiri",
	"Amatic SC",
	"Assistant",
	"Cormorant Garamond",
	"Teko",
	"Martel",
	"Caveat",
	"Maven Pro",
	"Domine",
	"Krona One",
	"PT Sans Caption",
	"Exo",
	"Fira Sans Condensed",
	"Orbitron",
	"Patua One",
	"Righteous",
	"Signika",
	"Neuton",
	"Rajdhani",
	"Crete Round",
	"DM Sans",
	"Nanum Myeongjo",
	"Ubuntu Condensed",
	"Inter",
	"Tajawal",
	"Satisfy",
	"Vollkorn",
	"Cinzel",
	"Noto Serif JP",
	"Architects Daughter",
	"Alfa Slab One",
	"Francois One",
	"Barlow Semi Condensed",
	"Cantarell",
	"Frank Ruhl Libre",
	"ABeeZee",
	"Patrick Hand",
	"Cousine",
	"Alegreya Sans",
	"Archivo",
	"Oleo Script",
	"Courgette",
	"Kalam",
	"Alegreya",
	"Kaushan Script",
	"Chewy",
	"Noticia Text",
	"Berkshire Swash",
	"Bungee",
	"Leckerli One",
	"Tinos",
	"Cardo",
	"Great Vibes",
	"Pathway Gothic One",
	"Cuprum",
	"Archivo Black",
	"Volkhov",
	"Rokkitt",
	"Yantramanav",
	"Lobster Two",
	"Hind Vadodara",
	"Sacramento",
	"Didact Gothic",
	"Istok Web",
	"News Cycle",
	"Piedra",
	"Concert One",
	"M PLUS 1p",
	"Old Standard TT",
	"Gloria Hallelujah",
	"Balsamiq Sans",
	"Hind Guntur",
	"Quattrocento Sans",
	"Taviraj",
	"Russo One",
	"Almarai",
	"Fira Sans Extra Condensed",
	"Squada One",
	"Poiret One",
	"Sarabun",
	"Passion One",
	"Prata",
	"Saira Semi Condensed",
	"Changa",
	"Parisienne",
	"Advent Pro",
	"Josefin Slab",
	"Ropa Sans",
	"Asap Condensed",
	"Sawarabi Mincho",
	"Special Elite",
	"Encode Sans",
	"BenchNine",
	"Cookie",
	"M PLUS Rounded 1c",
	"Chivo",
	"Montserrat Alternates",
	"Playfair Display SC",
	"Marck Script",
	"Baloo 2",
	"Vidaloka",
	"Quattrocento",
	"Monoton",
	"Ultra",
	"Gudea",
	"IBM Plex Mono",
	"Faustina",
	"Sanchez",
	"Ramabhadra",
	"Rock Salt",
	"Antic Slab",
	"Yellowtail",
	"Philosopher",
	"Khand",
	"Playball",
	"Saira Condensed",
	"Economica",
	"Arapey",
	"Ruda",
	"Unica One",
	"Bangers",
	"Adamina",
	"Karma",
	"Handlee",
	"Gentium Basic",
	"Hammersmith One",
	"Cabin Condensed",
	"Gothic A1",
	"Markazi Text",
	"El Messiri",
	"Press Start 2P",
	"Mitr",
	"Damion",
	"Pragati Narrow",
	"Electrolize",
	"Pridi",
	"Luckiest Guy",
	"Saira",
	"Actor",
	"Pontano Sans",
	"Bad Script",
	"Homemade Apple",
	"Spectral",
	"Enriqueta",
	"Spartan",
	"Armata",
	"Neucha",
	"Viga",
	"Nanum Gothic Coding",
	"Coda",
	"Alice",
	"Tangerine",
	"Cormorant",
	"Basic",
	"Itim",
	"Merienda",
	"PT Mono",
	"Sigmar One",
	"Rancho",
	"Jaldi",
	"Amaranth",
	"Lalezar",
	"Julius Sans One",
	"Mr Dafoe",
	"Gochi Hand",
	"Carter One",
	"Sawarabi Gothic",
	"Allura",
	"Audiowide",
	"Rambla",
	"Shadows Into Light Two",
	"Coda Caption",
	"Ubuntu Mono",
	"Lusitana",
	"Tenor Sans",
	"Chakra Petch",
	"Gentium Book Basic",
	"Fugaz One",
	"Candal",
	"Sarala",
	"Sriracha",
	"Covered By Your Grace",
	"Paytone One",
	"Signika Negative",
	"Alex Brush",
	"Yeseva One",
	"Kreon",
	"Marcellus",
	"Sorts Mill Goudy",
	"Abhaya Libre",
	"Yrsa",
	"Baloo Chettan 2",
	"Pinyon Script",
	"Jura",
	"Nothing You Could Do",
	"Khula",
	"Varela",
	"Judson",
	"DM Serif Display",
	"Jockey One",
	"Noto Serif TC",
	"Cantata One",
	"Palanquin",
	"Alef",
	"Nanum Pen Script",
	"Unna",
	"Aclonica",
	"PT Serif Caption",
	"Quantico",
	"Antic",
	"Sintony",
	"Noto Serif SC",
	"Black Han Sans",
	"Glegoo",
	"Spinnaker",
	"Bai Jamjuree",
	"Encode Sans Condensed",
	"Rufina",
	"Londrina Solid",
	"Knewave",
	"Reem Kufi",
	"Allerta",
	"Space Mono",
	"Saira Extra Condensed",
	"Trirong",
	"Aldrich",
	"Anonymous Pro",
	"Rubik Mono One",
	"Red Hat Display",
	"Black Ops One",
	"Arsenal",
	"Shrikhand",
	"Italianno",
	"Merienda One",
	"Lilita One",
	"Alegreya Sans SC",
	"Mada",
	"Fredericka the Great",
	"Lexend Deca",
	"Share Tech Mono",
	"Cedarville Cursive",
	"Forum",
	"Bevan",
	"Michroma",
	"Kadwa",
	"Capriola",
	"Bowlby One SC",
	"Suez One",
	"Boogaloo",
	"Six Caps",
	"Niconne",
	"Syncopate",
	"Aleo",
	"Scheherazade",
	"Martel Sans",
	"Mali",
	"Eczar",
	"Fira Mono",
	"Rozha One",
	"Overpass Mono",
	"Just Another Hand",
	"Arbutus Slab",
	"Bentham",
	"Hanuman",
	"Caveat Brush",
	"Share",
	"Cabin Sketch",
	"Arima Madurai",
	"Overlock",
	"VT323",
	"Mukta Malar",
	"Kosugi Maru",
	"Cinzel Decorative",
	"Gruppo",
	"Halant",
	"Scada",
	"Allan",
	"Montserrat Subrayada",
	"Red Hat Text",
	"Telex",
	"Days One",
	"Galada",
	"Biryani",
	"Nobile",
	"DM Serif Text",
	"Reenie Beanie",
	"Fondamento",
	"Allerta Stencil",
	"Fauna One",
	"Holtwood One SC",
	"Caudex",
	"Kameron",
	"Marcellus SC",
	"Krub",
	"Lateef",
	"Molengo",
	"Mrs Saint Delafield",
	"Racing Sans One",
	"Norican",
	"Annie Use Your Telescope",
	"Cutive Mono",
	"Do Hyeon",
	"Graduate",
	"Miriam Libre",
	"Gelasio",
	"Suranna",
	"Alegreya SC",
	"Sunflower",
	"Oranienbaum",
	"Montez",
	"Noto Serif KR",
	"Coustard",
	"Pattaya",
	"Bungee Inline",
	"Seaweed Script",
	"Coming Soon",
	"Yesteryear",
	"Public Sans",
	"Magra",
	"Arizonia",
	"Aladin",
	"Rye",
	"Contrail One",
	"Herr Von Muellerhoff",
	"IBM Plex Sans Condensed",
	"Average Sans",
	"Lustria",
	"Changa One",
	"Marmelad",
	"Modak",
	"Average",
	"Lemonada",
	"Grand Hotel",
	"Nanum Brush Script",
	"Mallanna",
	"Buenard",
	"Palanquin Dark",
	"IM Fell Double Pica",
	"Duru Sans",
	"Petit Formal Script",
	"Rochester",
	"Nixie One",
	"Slabo 13px",
	"Kristi",
	"Pangolin",
	"Chonburi",
	"Athiti",
	"Carrois Gothic",
	"Mulish",
	"Manrope",
	"Carme",
	"Copse",
	"Bubblegum Sans",
	"Chelsea Market",
	"Raleway Dots",
	"Sansita",
	"Belleza",
	"Gilda Display",
	"Chau Philomene One",
	"Calligraffitti",
	"Literata",
	"Rosario",
	"Amethysta",
	"Cambay",
	"Voltaire",
	"Metrophobic",
	"Kelly Slab",
	"Corben",
	"Averia Serif Libre",
	"Ovo",
	"Emilys Candy",
	"B612",
	"Schoolbell",
	"Maitree",
	"ZCOOL XiaoWei",
	"Mr De Haviland",
	"Mukta Vaani",
	"GFS Didot",
	"Delius",
	"Sedgwick Ave",
	"Jost",
	"Radley",
	"Oxygen Mono",
	"Tenali Ramakrishna",
	"Lekton",
	"Sofia",
	"Love Ya Like A Sister",
	"Codystar",
	"Amiko",
	"Mirza",
	"Laila",
	"Harmattan",
	"Ceviche One",
	"Montaga",
	"Niramit",
	"Cormorant Infant",
	"Gurajada",
	"Poly",
	"Vampiro One",
	"Mate",
	"Shojumaru",
	"Alata",
	"Freckle Face",
	"Lemon",
	"Titan One",
	"Goudy Bookletter 1911",
	"Vast Shadow",
	"Federo",
	"Gravitas One",
	"Sue Ellen Francisco",
	"Cutive",
	"Gugi",
	"Trocchi",
	"Marvel",
	"Kurale",
	"Gabriela",
	"IM Fell English",
	"Alike",
	"Maiden Orange",
	"Anaheim",
	"Rouge Script",
	"Convergence",
	"UnifrakturMaguntia",
	"Oleo Script Swash Caps",
	"Spectral SC",
	"Esteban",
	"Manjari",
	"Quando",
	"Battambang",
	"Amita",
	"Wallpoet",
	"Jua",
	"Megrim",
	"Cormorant SC",
	"Pavanam",
	"Inder",
	"Mandali",
	"Kosugi",
	"Secular One",
	"Pompiere",
	"Faster One",
	"Sniglet",
	"Balthazar",
	"Limelight",
	"La Belle Aurore",
	"Doppio One",
	"Stardos Stencil",
	"Expletus Sans",
	"Belgrano",
	"Share Tech",
	"Fanwood Text",
	"Baumans",
	"Sen",
	"Libre Barcode 39",
	"K2D",
	"Qwigley",
	"Farro",
	"McLaren",
	"B612 Mono",
	"Patrick Hand SC",
	"Rammetto One",
	"Homenaje",
	"Unkempt",
	"Rasa",
	"Meera Inimai",
	"Rakkas",
	"Brawler",
	"Encode Sans Semi Expanded",
	"Bellefair",
	"Waiting for the Sunrise",
	"Clicker Script",
	"Katibeh",
	"Finger Paint",
	"Salsa",
	"Andada",
	"Charm",
	"Vesper Libre",
	"Sarpanch",
	"Podkova",
	"Cambo",
	"Proza Libre",
	"Tauri",
	"Crafty Girls",
	"Zeyada",
	"NTR",
	"Andika",
	"Cormorant Upright",
	"Dawning of a New Day",
	"Sedgwick Ave Display",
	"BioRhyme",
	"Oregano",
	"Mansalva",
	"Numans",
	"Frijole",
	"Nova Square",
	"Fjord One",
	"Strait",
	"Walter Turncoat",
	"Ledger",
	"Euphoria Script",
	"Mountains of Christmas",
	"Be Vietnam",
	"Bungee Shade",
	"Padauk",
	"Almendra",
	"Carrois Gothic SC",
	"Aguafina Script",
	"IM Fell DW Pica",
	"Skranji",
	"Happy Monkey",
	"Give You Glory",
	"Timmana",
	"Gafata",
	"Poller One",
	"Iceland",
	"Livvic",
	"Bowlby One",
	"Shanti",
	"Averia Libre",
	"Meddon",
	"David Libre",
	"Denk One",
	"Encode Sans Semi Condensed",
	"Wendy One",
	"Loved by the King",
	"Baloo Da 2",
	"Eater",
	"Antic Didone",
	"Cantora One",
	"Prosto One",
	"Vollkorn SC",
	"Mouse Memoirs",
	"Big Shoulders Text",
	"Mako",
	"Sail",
	"Encode Sans Expanded",
	"Hepta Slab",
	"Short Stack",
	"Cherry Swash",
	"Imprima",
	"Alatsi",
	"Over the Rainbow",
	"Artifika",
	"Bilbo Swash Caps",
	"Tienne",
	"Puritan",
	"Life Savers",
	"Baskervville",
	"Inknut Antiqua",
	"Sonsie One",
	"Delius Swash Caps",
	"Crimson Pro",
	"Jomolhari",
	"Arya",
	"IM Fell French Canon SC",
	"Ranchers",
	"Voces",
	"Alike Angular",
	"Lily Script One",
	"Metamorphous",
	"Creepster",
	"IM Fell English SC",
	"Darker Grotesque",
	"Baloo Thambi 2",
	"Dokdo",
	"The Girl Next Door",
	"Asul",
	"Ruluko",
	"Averia Sans Libre",
	"Medula One",
	"Port Lligat Sans",
	"Orienta",
	"Nova Mono",
	"Atma",
	"Tulpen One",
	"Vibur",
	"Amarante",
	"Srisakdi",
	"Averia Gruesa Libre",
	"Girassol",
	"Lexend Zetta",
	"Headland One",
	"Zilla Slab Highlight",
	"Spicy Rice",
	"Cherry Cream Soda",
	"Dynalight",
	"Port Lligat Slab",
	"Ibarra Real Nova",
	"Trade Winds",
	"Monsieur La Doulaise",
	"Elsie",
	"Thasadith",
	"Slackey",
	"Ruslan Display",
	"Mate SC",
	"Geo",
	"Notable",
	"Baloo Bhaina 2",
	"Manuale",
	"Saira Stencil One",
	"Nosifer",
	"Farsan",
	"Aref Ruqaa",
	"Caladea",
	"Bilbo",
	"Kumar One",
	"Gaegu",
	"Wire One",
	"Spirax",
	"Sirin Stencil",
	"Fontdiner Swanky",
	"Dekko",
	"Comic Neue",
	"Just Me Again Down Here",
	"Rationale",
	"Sumana",
	"Chathura",
	"Ribeye Marrow",
	"Coiny",
	"Ewert",
	"Libre Caslon Text",
	"Italiana",
	"Blinker",
	"Ma Shan Zheng",
	"Scope One",
	"Germania One",
	"Mukta Mahee",
	"Ribeye",
	"Calistoga",
	"Big Shoulders Display",
	"Peralta",
	"Sarina",
	"Flamenco",
	"Chango",
	"Fira Code",
	"Fascinate Inline",
	"Yatra One",
	"Delius Unicase",
	"Jacques Francois Shadow",
	"Chicle",
	"League Script",
	"Yeon Sung",
	"Song Myung",
	"Engagement",
	"Hi Melody",
	"Habibi",
	"Macondo Swash Caps",
	"Grenze",
	"Gamja Flower",
	"Kranky",
	"Crushed",
	"Henny Penny",
	"Trochut",
	"Tillana",
	"Quintessential",
	"Nova Cut",
	"Ranga",
	"Koulen",
	"Nova Round",
	"Marko One",
	"Kite One",
	"Stoke",
	"Pirata One",
	"Mogra",
	"Khmer",
	"Oxanium",
	"Milonga",
	"Ramaraja",
	"Mystery Quest",
	"Gupter",
	"Libre Barcode 39 Extended Text",
	"Fenix",
	"Rosarivo",
	"UnifrakturCook",
	"Lakki Reddy",
	"Englebert",
	"Barrio",
	"Lovers Quarrel",
	"Simonetta",
	"Stylish",
	"Stalemate",
	"Unlock",
	"Donegal One",
	"Paprika",
	"Swanky and Moo Moo",
	"Croissant One",
	"Text Me One",
	"Monofett",
	"Mina",
	"Moul",
	"Asar",
	"Barriecito",
	"Stint Ultra Condensed",
	"Akronim",
	"Sancreek",
	"IM Fell French Canon",
	"Kodchasan",
	"Condiment",
	"Rum Raisin",
	"Fresca",
	"Prociono",
	"Kotta One",
	"Nokora",
	"Margarine",
	"Cormorant Unicase",
	"Angkor",
	"Bubbler One",
	"Bayon",
	"Dorsa",
	"Odibee Sans",
	"Londrina Outline",
	"Joti One",
	"Suwannaphum",
	"Petrona",
	"Buda",
	"Cagliostro",
	"Sura",
	"Uncial Antiqua",
	"Junge",
	"Overlock SC",
	"Rowdies",
	"Stint Ultra Expanded",
	"IM Fell Great Primer",
	"Kulim Park",
	"Eagle Lake",
	"New Rocker",
	"Kantumruy",
	"Bigshot One",
	"Arbutus",
	"Bellota Text",
	"Iceberg",
	"Courier Prime",
	"Julee",
	"Galdeano",
	"Della Respira",
	"Diplomata",
	"Metal Mania",
	"Chela One",
	"Elsie Swash Caps",
	"Charmonman",
	"Red Rose",
	"Redressed",
	"KoHo",
	"Sree Krushnadevaraya",
	"Odor Mean Chey",
	"Vibes",
	"Linden Hill",
	"Nova Slim",
	"Major Mono Display",
	"Bellota",
	"Sora",
	"Diplomata SC",
	"Nova Flat",
	"ZCOOL QingKe HuangYou",
	"Miniver",
	"Goblin One",
	"Baloo Paaji 2",
	"Wellfleet",
	"Trykker",
	"Offside",
	"Kavoon",
	"Autour One",
	"Fahkwang",
	"Jomhuria",
	"Hanalei Fill",
	"Snippet",
	"Flavors",
	"Libre Barcode 128",
	"Inika",
	"Rhodium Libre",
	"Cute Font",
	"MuseoModerno",
	"Glass Antiqua",
	"Jim Nightshade",
	"Molle",
	"Content",
	"Smythe",
	"Black And White Picture",
	"Baloo Bhai 2",
	"Meie Script",
	"Ruthie",
	"MedievalSharp",
	"Griffy",
	"Modern Antiqua",
	"IM Fell DW Pica SC",
	"Bahiana",
	"Lexend Exa",
	"Grenze Gotisch",
	"Bokor",
	"Devonshire",
	"Inria Serif",
	"Felipa",
	"Sahitya",
	"Libre Barcode 39 Extended",
	"Dangrek",
	"Oldenburg",
	"Original Surfer",
	"Mrs Sheppards",
	"Revalia",
	"Smokum",
	"Varta",
	"Underdog",
	"Freehand",
	"Princess Sofia",
	"Kavivanar",
	"Libre Barcode 39 Text",
	"Asset",
	"Irish Grover",
	"Lancelot",
	"Keania One",
	"Atomic Age",
	"Londrina Shadow",
	"Purple Purse",
	"East Sea Dokdo",
	"Lexend Tera",
	"Tomorrow",
	"Caesar Dressing",
	"Snowburst One",
	"Poor Story",
	"Dr Sugiyama",
	"Ravi Prakash",
	"Emblema One",
	"Taprom",
	"Epilogue",
	"Bigelow Rules",
	"Sulphur Point",
	"Almendra SC",
	"Romanesco",
	"Siemreap",
	"Gotu",
	"Plaster",
	"Almendra Display",
	"Libre Barcode 128 Text",
	"Kumar One Outline",
	"Jacques Francois",
	"Miss Fajardose",
	"Libre Caslon Display",
	"Supermercado One",
	"Gorditas",
	"IM Fell Double Pica SC",
	"Gayathri",
	"IM Fell Great Primer SC",
	"Sevillana",
	"Galindo",
	"GFS Neohellenic",
	"Fascinate",
	"Metal",
	"Risque",
	"Jolly Lodger",
	"Bungee Outline",
	"Ruge Boogie",
	"Bonbon",
	"Astloch",
	"Macondo",
	"Solway",
	"Preahvihear",
	"Sunshiney",
	"Lacquer",
	"Mr Bedfort",
	"Federant",
	"Butterfly Kids",
	"Chilanka",
	"DM Mono",
	"ZCOOL KuaiLe",
	"Butcherman",
	"Seymour One",
	"Nova Oval",
	"Kirang Haerang",
	"Bungee Hairline",
	"Sofadi One",
	"Beth Ellen",
	"Erica One",
	"Fruktur",
	"Peddana",
	"Miltonian Tattoo",
	"Combo",
	"Nova Script",
	"Gidugu",
	"Suravaram",
	"Liu Jian Mao Cao",
	"Passero One",
	"Geostar Fill",
	"Zhi Mang Xing",
	"Single Day",
	"Aubrey",
	"Londrina Sketch",
	"Chenla",
	"Miltonian",
	"Inria Sans",
	"Kdam Thmor",
	"Geostar",
	"Kenia",
	"Moulpali",
	"Lexend Giga",
	"Stalinist One",
	"Dhurjati",
	"Turret Road",
	"Hanalei",
	"BioRhyme Expanded",
	"Fasthand",
	"Baloo Tamma 2",
	"Long Cang",
	"Lexend Mega",
	"Warnes",
	"Lexend Peta",
	"Bahianita",
	"Viaoda Libre",
	"Baloo Tammudu 2",
	"Recursive"
];

const defaultTypographyFields = {
	family: '',
	weight: '',
	transform: '',
	style: '',
	decoration: '',
	
	sizeUnit: 'px',
	
	sizeDesktop: 16,
	sizeTablet: 16,
	sizeMobile: 16,
	
	lineHeightUnit: 'em',
	
	lineHeightDesktop: 1,
	lineHeightTablet:  1,
	lineHeightMobile:  1,
	
	letterSpacingDesktop: 0,
	letterSpacingTablet: 0,
	letterSpacingMobile: 0
}


/**
 * Main UI control component for Typography
 */
class TypographyControl extends Component {

	constructor() {
		super( ...arguments );
		
		this.state = { 
			showReset: false,
			defaultValues: this.props.attributes[this.props.optionsLabel],
			popover: false,
			sizeSize: 'desktop',
			lineHeightSize: 'desktop',
			letterSpacingSize: 'desktop',
		}
		
	}
	
	setValue( val, name ) {
		let newValues = {};
		newValues[this.props.optionsLabel] = Object.assign( {}, this.props.attributes[this.props.optionsLabel] );
		newValues[this.props.optionsLabel][name] = val;
		this.props.setAttributes( newValues );
		this.setState({ showReset: true });
	}

	render() {
		// prepare options 
		const fontsList = [
			{ label: 'Default', value: '' },
		];
		
		gfonts.forEach((item) => {
			fontsList.push({
				label: item,
				value: item
			});
		});
		
		return ( 
			<Fragment>
				<div className="epbl-typography">
					<div className="epbl-typography__header">
						{ __( 'Typography' ) }
					</div>
					<div className="epbl-typography__buttons">
						{ this.state.showReset &&
							<Button isSecondary onClick={ () => {
									this.props.setAttributes( this.state.defaultValues ) 
									let newValues = {};
									newValues[this.props.optionsLabel] = Object.assign( {}, this.state.defaultValues );
									this.props.setAttributes( newValues );
									this.setState({ showReset: false });
								} }
							>
								<Dashicon icon="image-rotate" />
							</Button>
						}
						<Button isSecondary onClick={ () => this.setState({ popover: !this.state.popover }) }>
							<Dashicon icon="admin-tools" />
						</Button>
						{ this.state.popover && 
							<Popover
								className="epbl-typography__modal"
								position="right bottom"
								onClose={ () => this.setState({ popover: false }) }
							>
								<SelectControl
									label="Font Family"
									value={ this.props.attributes[this.props.optionsLabel].family }
									options={ fontsList }
									onChange={ ( val ) => this.setValue( val, 'family' ) }
								/>
								
								<div className="epbl-typography__ranges-header">
									<div className="epbl-typography__ranges-header__text">{ __('Size') }</div>
									<ButtonGroup>
										<Button isSecondary onClick={ () => this.setState( { sizeSize : 'desktop' } ) } className={ this.state.sizeSize == 'desktop' ? 'active' : '' }>
											<Dashicon icon="desktop"/>
										</Button>
										<Button isSecondary onClick={ () => this.setState( { sizeSize : 'tablet' } ) } className={ this.state.sizeSize == 'tablet' ? 'active' : '' }>
											<Dashicon icon="tablet"/>
										</Button>
										<Button isSecondary onClick={ () => this.setState( { sizeSize : 'smartphone' } ) } className={ this.state.sizeSize == 'smartphone' ? 'active' : '' }>
											<Dashicon icon="smartphone"/>
										</Button>
									</ButtonGroup>
									<ButtonGroup>
										<Button isSecondary onClick={ () => this.setValue( 'px', 'sizeUnit' ) } className={ this.props.attributes[this.props.optionsLabel].sizeUnit == 'px' ? 'active' : '' }>
											px
										</Button>
										<Button isSecondary onClick={ () => this.setValue( 'em', 'sizeUnit' ) } className={ this.props.attributes[this.props.optionsLabel].sizeUnit == 'em' ? 'active' : '' }>
											em
										</Button>
									</ButtonGroup>
								</div>
								<div className="epbl-typography__ranges">
									{
										this.state.sizeSize == 'desktop' &&
										
										<RangeControl
											value={[this.props.optionsLabel].sizeDesktop}
											onChange={(val) => this.setValue( val, 'sizeDesktop' )}
											min={1}
											max={70}
											step={0.25}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].sizeDesktop}
										/>
									}
									{
										this.state.sizeSize == 'tablet' &&
										
										<RangeControl
											value={[this.props.optionsLabel].sizeTablet}
											onChange={(val) => this.setValue( val, 'sizeTablet' )}
											min={1}
											max={70}
											step={0.25}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].sizeTablet}
										/>
									}
									{
										this.state.sizeSize == 'smartphone' &&
										
										<RangeControl
											value={[this.props.optionsLabel].sizeMobile}
											onChange={(val) => this.setValue( val, 'sizeMobile' )}
											min={1}
											max={70}
											step={0.25}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].sizeMobile}
										/>
									}
								</div>
								
								<SelectControl
									label= { __( 'Font Weight' ) }
									value={ this.props.attributes[this.props.optionsLabel].weight }
									options={ [
										{ value: '', label: __( 'Default' ) },
										{ value: '100', label: '100' },
										{ value: '200', label: '200' },
										{ value: '300', label: '300' },
										{ value: '400', label: '400' },
										{ value: '500', label: '500' },
										{ value: '600', label: '600' },
										{ value: '700', label: '700' },
										{ value: '800', label: '800' },
										{ value: '900', label: '900' }
									]}
									onChange={ ( val ) => this.setValue( val, 'weight' ) }
								/>
								
								<SelectControl
									label= { __( 'Transform' ) }
									value={ this.props.attributes[this.props.optionsLabel].transform }
									options={ [
										{ value: '', label: __( 'Default' ) },
										{ value: 'uppercase', label: __( 'Uppercase' ) },
										{ value: 'lowercase', label: __( 'Lowercase' ) },
										{ value: 'capitalize', label: __( 'Capitalize' ) },
										{ value: 'none', label: __( 'Normal' ) },
									]}
									onChange={ ( val ) => this.setValue( val, 'transform' ) }
								/>
								
								<SelectControl
									label= { __( 'Style' ) }
									value={ this.props.attributes[this.props.optionsLabel].style }
									options={ [
										{ value: '', label: __( 'Default' ) },
										{ value: 'normal', label: __( 'Normal' ) },
										{ value: 'italic', label: __( 'Italic' ) },
										{ value: 'oblique', label: __( 'Oblique' ) },
									]}
									onChange={ ( val ) => this.setValue( val, 'style' ) }
								/>
								
								<SelectControl
									label= { __( 'Decoration' ) }
									value={ this.props.attributes[this.props.optionsLabel].decoration }
									options={ [
										{ value: '', label: __( 'Default' ) },
										{ value: 'underline', label: __( 'Underline' ) },
										{ value: 'overline', label: __( 'Overline' ) },
										{ value: 'line-through', label: __( 'Line Through' ) },
										{ value: 'none', label: __( 'None' ) },
									]}
									onChange={ ( val ) => this.setValue( val, 'decoration' ) }
								/>
								
								<div className="epbl-typography__ranges-header">
									<div className="epbl-typography__ranges-header__text">{ __('Line-Height') }</div>
									<ButtonGroup>
										<Button isSecondary onClick={ () => this.setState( { lineHeightSize : 'desktop' } ) } className={ this.state.lineHeightSize == 'desktop' ? 'active' : '' }>
											<Dashicon icon="desktop"/>
										</Button>
										<Button isSecondary onClick={ () => this.setState( { lineHeightSize : 'tablet' } ) } className={ this.state.lineHeightSize == 'tablet' ? 'active' : '' }>
											<Dashicon icon="tablet"/>
										</Button>
										<Button isSecondary onClick={ () => this.setState( { lineHeightSize : 'smartphone' } ) } className={ this.state.lineHeightSize == 'smartphone' ? 'active' : '' }>
											<Dashicon icon="smartphone"/>
										</Button>
									</ButtonGroup>
									<ButtonGroup>
										<Button isSecondary onClick={ () => this.setValue( 'px', 'lineHeightUnit' ) } className={ this.props.attributes[this.props.optionsLabel].lineHeightUnit == 'px' ? 'active' : '' }>
											px
										</Button>
										<Button isSecondary onClick={ () => this.setValue( 'em', 'lineHeightUnit' ) } className={ this.props.attributes[this.props.optionsLabel].lineHeightUnit == 'em' ? 'active' : '' }>
											em
										</Button>
									</ButtonGroup>
								</div>
								<div className="epbl-typography__ranges">
									{
										this.state.lineHeightSize == 'desktop' &&
										
										<RangeControl
											value={[this.props.optionsLabel].lineHeightDesktop}
											onChange={(val) => this.setValue( val, 'lineHeightDesktop' )}
											min={1}
											max={3}
											step={0.1}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].lineHeightDesktop}
										/>
									}
									{
										this.state.lineHeightSize == 'tablet' &&
										
										<RangeControl
											value={[this.props.optionsLabel].lineHeightTablet}
											onChange={(val) => this.setValue( val, 'lineHeightTablet' )}
											min={1}
											max={3}
											step={0.1}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].lineHeightTablet}
										/>
									}
									{
										this.state.lineHeightSize == 'smartphone' &&
										
										<RangeControl
											value={[this.props.optionsLabel].lineHeightMobile}
											onChange={(val) => this.setValue( val, 'lineHeightMobile' )}
											min={1}
											max={3}
											step={0.1}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].lineHeightMobile}
										/>
									}
								</div>
								
								<div className="epbl-typography__ranges-header">
									<div className="epbl-typography__ranges-header__text">{ __('Letter Spacing') }</div>
									<ButtonGroup>
										<Button isSecondary onClick={ () => this.setState( { letterSpacingSize : 'desktop' } ) } className={ this.state.letterSpacingSize == 'desktop' ? 'active' : '' }>
											<Dashicon icon="desktop"/>
										</Button>
										<Button isSecondary onClick={ () => this.setState( { letterSpacingSize : 'tablet' } ) } className={ this.state.letterSpacingSize == 'tablet' ? 'active' : '' }>
											<Dashicon icon="tablet"/>
										</Button>
										<Button isSecondary onClick={ () => this.setState( { letterSpacingSize : 'smartphone' } ) } className={ this.state.letterSpacingSize == 'smartphone' ? 'active' : '' }>
											<Dashicon icon="smartphone"/>
										</Button>
									</ButtonGroup>
								</div>
								<div className="epbl-typography__ranges">
									{
										this.state.letterSpacingSize == 'desktop' &&
										
										<RangeControl
											value={[this.props.optionsLabel].letterSpacingDesktop}
											onChange={(val) => this.setValue( val, 'letterSpacingDesktop' )}
											min={1}
											max={70}
											step={0.25}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].letterSpacingDesktop}
										/>
									}
									{
										this.state.letterSpacingSize == 'tablet' &&
										
										<RangeControl
											value={[this.props.optionsLabel].letterSpacingTablet}
											onChange={(val) => this.setValue( val, 'letterSpacingTablet' )}
											min={1}
											max={70}
											step={0.25}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].letterSpacingTablet}
										/>
									}
									{
										this.state.letterSpacingSize == 'smartphone' &&
										
										<RangeControl
											value={[this.props.optionsLabel].letterSpacingMobile}
											onChange={(val) => this.setValue( val, 'letterSpacingMobile' )}
											min={1}
											max={70}
											step={0.25}
											beforeIcon= 'editor-textcolor'
											initialPosition={this.props.attributes[this.props.optionsLabel].letterSpacingMobile}
										/>
									}
								</div>
							</Popover>
						}
						
					</div>
				</div>
			</Fragment>
		);
	}
}

function getTypographyStyles( selector, options ) {
	
	let $selectors_desktop = {};
	$selectors_desktop[selector] = {};
	let $selectors_tablet = {};
	$selectors_tablet[selector] = {};
	let $selectors_mobile = {};
	$selectors_mobile[selector] = {};
	
	for ( var key in options) {
		if ( 'family' == key && options[key] ) {
			$selectors_desktop[selector]['font-family'] = '"' + options[key] + '"';
		}
		
		if ( 'weight' == key && options[key]  ) {
			$selectors_desktop[selector]['font-weight'] = options[key];
		}
		
		if ( 'transform' == key && options[key]  ) {
			$selectors_desktop[selector]['text-transform'] = options[key];
		}

		if ( 'style' == key && options[key]  ) {
			$selectors_desktop[selector]['font-style'] = options[key];
		}

		if ( 'decoration' == key && options[key]  ) {
			$selectors_desktop[selector]['text-decoration'] = options[key];
		}

		if ( 'sizeDesktop' == key && options[key]  ) {
			$selectors_desktop[selector]['font-size'] = options[key] + options.sizeUnit;
		}

		if ( 'sizeTablet' == key && options[key]  ) {
			$selectors_tablet[selector]['font-size'] = options[key] + options.sizeUnit;
		}

		if ( 'sizeMobile' == key && options[key]  ) {
			$selectors_mobile[selector]['font-size'] = options[key] + options.sizeUnit;
		}

		if ( 'lineHeightDesktop' == key && options[key]  ) {
			$selectors_desktop[selector]['line-height'] = options[key] + options.lineHeightUnit;
		}

		if ( 'lineHeightTablet' == key && options[key]  ) {
			$selectors_tablet[selector]['line-height'] = options[key] + options.lineHeightUnit;
		}

		if ( 'lineHeightMobile' == key && options[key]  ) {
			$selectors_mobile[selector]['line-height'] = options[key] + options.lineHeightUnit;
		}

		if ( 'letterSpacingDesktop' == key && options[key]  ) {
			$selectors_desktop[selector]['letter-spacing'] = options[key] + 'px';
		}

		if ( 'letterSpacingTablet' == key && options[key]  ) {
			$selectors_tablet[selector]['letter-spacing'] = options[key] + 'px';
		}

		if ( 'letterSpacingMobile' == key && options[key]  ) {
			$selectors_mobile[selector]['letter-spacing'] = options[key] + 'px';
		}
	}
	
	let styling_css = '';
	
	styling_css += generate_block_css( $selectors_desktop, '' );
	styling_css += generate_block_css( $selectors_tablet, '', "tablet" );
	styling_css += generate_block_css( $selectors_mobile, '', "mobile" );
	
	return styling_css;
}

function getTypographyImports( options ) {
	
	let imports = '';
	
	if ( options.family ) {
		imports += "@import url('https://fonts.googleapis.com/css2?family="+options.family.replace(/ /g, '+')+"');";
	}
	
	return imports;
}

export default TypographyControl;
export { defaultTypographyFields, getTypographyStyles, getTypographyImports };