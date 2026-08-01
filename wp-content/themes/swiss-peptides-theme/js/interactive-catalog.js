/**
 * Swiss Peptides Labs Colombia - Master 40 Products Engine 2026
 * 100% Explicit 1-to-1 Product Dictionary, 5 Categories including 'Sueño & Bienestar'
 */

const rawDbProducts = [
  {
    "id": "25",
    "title": "Agua Bacteriostática",
    "slug": "bacteriostatic-water",
    "price": 740000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/bacteriostatic_water_perfect_ai_v1_1785075353.jpg",
    "excerpt": "El Agua Bacteriostática es una preparación estéril y no pirogénica de agua para inyección que contiene 0.9% (9 mg/mL) de alcohol bencílico como conservante bacteriostático. Se utiliza como diluyente para la reconstitución de péptidos liofilizados."
  },
  {
    "id": "19",
    "title": "AicaBurn",
    "slug": "aicaburn",
    "price": 780000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/ampboost_perfect_ai_v1_1784989120.jpg",
    "excerpt": "AICAR (ribonucleótido de 5-aminoimidazol-4-carboxamida) es un compuesto metabólico de investigación reconocido por su capacidad para activar la proteína quinasa activada por AMP (AMPK), un sensor energético celular clave involucrado en el metabolismo de la glucosa y los lípidos."
  },
  {
    "id": "21",
    "title": "AOD-9604",
    "slug": "aod-9604",
    "price": 460000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/lipocore_perfect_ai_v1_1784989120.jpg",
    "excerpt": "AOD-9604 es un fragmento modificado de la hormona de crecimiento humano (hGH), específicamente el fragmento C-terminal (Tyr-hGH177-191). Se investiga por sus propiedades lipolíticas (quema de grasa) sin afectar los niveles de glucosa en sangre ni la proliferación celular."
  },
  {
    "id": "23",
    "title": "Appetitex",
    "slug": "appetitex",
    "price": 1100000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/appetitex_perfect_ai_v1_1784989120.jpg",
    "excerpt": "Cagrilintida es un análogo de acción prolongada de la amilina, una hormona peptídica cosecretada con la insulina por las células beta pancreáticas. Se estudia activamente por su papel en la regulación del control del apetito y el metabolismo gastrointestinal."
  },
  {
    "id": "27",
    "title": "Botulift",
    "slug": "botulift",
    "price": 900000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/botulift_flawless_studio_clean_v10_1785005226.jpg",
    "excerpt": "SNAP-8, también conocido como Acetil Octapéptido-3, es un péptido sintético derivado de la secuencia proteica SNAP-25, que desempeña un papel en la liberación de neurotransmisores en la unión neuromuscular. Se investiga por su potencial antienvejecimiento."
  },
  {
    "id": "29",
    "title": "BPC-157 + TB-500",
    "slug": "bpc-157-tb-500",
    "price": 700000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/regen_x_perfect_ai_v1_1784989120.jpg",
    "excerpt": "Este vial contiene una combinación sinérgica de dos péptidos de investigación: BPC-157 y TB-500, suministrados como polvo liofilizado. BPC-157 se estudia por sus propiedades regenerativas y TB-500 por su papel en la reparación tisular."
  },
  {
    "id": "31",
    "title": "BPC-Healix",
    "slug": "bpc-healix",
    "price": 700000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/bpc_healix_perfect_ai_v1_1784989120.jpg",
    "excerpt": "BPC-157 (Compuesto de Protección Corporal-157) es un pentadecapéptido sintético derivado de una proteína protectora que se encuentra naturalmente en el jugo gástrico. Se investiga ampliamente por su papel en la reparación tisular y la protección gastrointestinal."
  },
  {
    "id": "33",
    "title": "BronzeX",
    "slug": "bronzex",
    "price": 800000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/botulift_flawless_studio_clean_v10_1785005226.jpg",
    "excerpt": "Melanotan II es un análogo sintético de la hormona peptídica de melanocortina α-MSH (hormona estimulante de melanocitos alfa). Se investiga activamente por su papel en la estimulación de la melanogénesis, el proceso natural de producción de pigmento en la piel."
  },
  {
    "id": "35",
    "title": "DermaCooper",
    "slug": "dermacooper",
    "price": 960000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/dermacopperx_perfect_ai_1784990184.jpg",
    "excerpt": "GHK-Cu (Tripéptido de Cobre-1) es un péptido de unión al cobre de origen natural compuesto por tres aminoácidos (glicina, histidina y lisina). Se investiga extensamente por su papel en la reparación tisular y la regeneración cutánea."
  },
  {
    "id": "37",
    "title": "DermaKPV",
    "slug": "dermakpv",
    "price": 760000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/bronzex_perfect_ai_v1_1784994798.jpg",
    "excerpt": "KPV (Lisina-Prolina-Valina) es un tripéptido de origen natural derivado de la secuencia C-terminal de la α-MSH. Se investiga activamente por sus potentes propiedades antiinflamatorias e inmunomoduladoras."
  },
  {
    "id": "39",
    "title": "Epitalon",
    "slug": "epitalon",
    "price": 680000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/telomax_perfect_ai_v1_1784989820.jpg",
    "excerpt": "Epithalón es un tetrapéptido sintético de investigación con la secuencia de aminoácidos Ala-Glu-Asp-Gly. Se estudia por sus efectos potenciales sobre la actividad de la telomerasa y su papel en el envejecimiento celular y la longevidad."
  },
  {
    "id": "41",
    "title": "Erosense",
    "slug": "erosense",
    "price": 640000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/dermakpv_perfect_ai_v1_1784994798.jpg",
    "excerpt": "PT-141, también conocido como Bremelanotida, es un péptido sintético derivado del sistema de melanocortina reconocido por su papel en la señalización del sistema nervioso central relacionada con la motivación y la función sexual."
  },
  {
    "id": "43",
    "title": "FertiNova",
    "slug": "fertinova",
    "price": 900000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/erosense_perfect_ai_v1_1784994798.jpg",
    "excerpt": "Kisspeptina es un neuropéptido de origen natural que desempeña un papel central en la regulación del eje hipotalámico-hipofisario-gonadal (HPG). Se reconoce como un activador clave de la liberación de hormona liberadora de gonadotropinas (GnRH)."
  },
  {
    "id": "45",
    "title": "GHR-Prime",
    "slug": "ghr-prime",
    "price": 580000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/fertinova_perfect_ai_v1_1784994798.jpg",
    "excerpt": "GHRP-2 (Péptido Liberador de Hormona de Crecimiento-2) es un hexapéptido sintético reconocido por su capacidad para estimular la liberación de hormona de crecimiento (GH) mediante la activación del receptor de grelina (GHS-R1a)."
  },
  {
    "id": "47",
    "title": "GlutaPureX",
    "slug": "glutapurex",
    "price": 700000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/glutapurex_perfect_ai_1784960596.jpg",
    "excerpt": "El Glutatión es un tripéptido de origen natural compuesto por ácido glutámico, cisteína y glicina. Es reconocido como uno de los antioxidantes intracelulares más importantes, desempeñando un papel central en la defensa contra el estrés oxidativo."
  },
  {
    "id": "49",
    "title": "GonadoMax",
    "slug": "gonadomax",
    "price": 780000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/gonadomax_perfect_ai_v1_1785075353.jpg",
    "excerpt": "La Gonadotropina Menopáusica Humana (HMG) es un complejo de gonadotropinas purificadas compuesto principalmente por hormona foliculoestimulante (FSH) y hormona luteinizante (LH). Se investiga en estudios de fertilidad y función reproductiva."
  },
  {
    "id": "51",
    "title": "GrowthPrime",
    "slug": "growthprime",
    "price": 1100000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/growthprime_perfect_ai_v1_1785012066.jpg",
    "excerpt": "Sermorelina es un análogo peptídico sintético de la hormona liberadora de hormona de crecimiento (GHRH) que estimula la liberación natural de GH desde la hipófisis anterior de manera pulsátil y fisiológica."
  },
  {
    "id": "53",
    "title": "IGF-Novax",
    "slug": "igf-novax",
    "price": 960000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/igfnovax_perfect_ai_v1_1785012066.jpg",
    "excerpt": "El Factor de Crecimiento Similar a la Insulina 1 Long Arg3 (IGF-1 LR3) es un análogo modificado del IGF-1 nativo con una vida media extendida y mayor potencia biológica. Se investiga por su papel en el crecimiento celular y la hipertrofia muscular."
  },
  {
    "id": "55",
    "title": "ImmunoThyx",
    "slug": "immunothyx",
    "price": 800000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/immunothyx_perfect_ai_v1_1785012066.jpg",
    "excerpt": "Timosina Alfa-1 (Tα1) es un péptido inmunomodulador de origen natural derivado de la proteína tímica protimosin alfa. Se investiga por su capacidad para modular y fortalecer la respuesta inmune adaptativa e innata."
  },
  {
    "id": "57",
    "title": "IpaGrow",
    "slug": "ipagrow",
    "price": 900000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/ipagrow_perfect_ai_v1_1785012066.jpg",
    "excerpt": "Ipamoreina es un péptido liberador de hormona de crecimiento (GHRP) sintético que estimula selectivamente la secreción de GH con mínimos efectos secundarios sobre el cortisol, la prolactina y el apetito."
  },
  {
    "id": "59",
    "title": "KlowXtreme",
    "slug": "klowxtreme",
    "price": 1100000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/klowxtreme_perfect_ai_1784960596.jpg",
    "excerpt": "KLOW es un péptido sintético de investigación formulado para el estudio de la hidratación celular, la regulación metabólica y la optimización de los procesos de recuperación a nivel tisular."
  },
  {
    "id": "61",
    "title": "LipoBurn",
    "slug": "lipoburn",
    "price": 760000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/lipoburn_perfect_ai_v1_1785013150.jpg",
    "excerpt": "LL-37 es un péptido sintético de investigación derivado de la catelicidina antimicrobiana humana. Se investiga por sus potentes propiedades antimicrobianas, inmunomoduladoras y de curación de heridas."
  },
  {
    "id": "63",
    "title": "LipoLean",
    "slug": "lipolean",
    "price": 1040000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/lipolean_perfect_ai_v1_1785013150.jpg",
    "excerpt": "GLOW es una formulación peptídica sintética de investigación desarrollada para estudios avanzados en regeneración celular cutánea, luminosidad y protección contra el envejecimiento prematuro de la piel."
  },
  {
    "id": "65",
    "title": "LipoVite",
    "slug": "lipovite",
    "price": 1100000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/lipovite_perfect_ai_v1_1785013150.jpg",
    "excerpt": "MOTS-C es un péptido derivado de la mitocondria codificado por el ADN mitocondrial, reconocido por su papel en la regulación del metabolismo energético, la sensibilidad a la insulina y la homeostasis celular."
  },
  {
    "id": "67",
    "title": "LongevityMax",
    "slug": "longevitymax",
    "price": 1400000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/longevitymax_perfect_ai_v1_1785013150.jpg",
    "excerpt": "SS-31, también conocido como Elamipretida, es un péptido sintético dirigido a las mitocondrias, diseñado para proteger y restaurar la función mitocondrial al estabilizar la cardiolipina en la membrana mitocondrial interna."
  },
  {
    "id": "488",
    "title": "MyoGlow",
    "slug": "myoglow",
    "price": 1400000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/myoglow_perfect_ai_v1_1785013150.jpg",
    "excerpt": "MOTS-C (Mitochondrial Open Reading Frame of the 12S rRNA-c) es un péptido derivado del ADN mitocondrial que regula la homeostasis metabólica, promueve la sensibilidad a la insulina y optimiza la capacidad de resistencia muscular y la longevidad celular."
  },
  {
    "id": "69",
    "title": "NAD+",
    "slug": "nad-plus",
    "price": 700000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/longevityx_perfect_ai_v2_1784993894.jpg",
    "excerpt": "La Nicotinamida Adenina Dinucleótido (NAD+) es una coenzima crítica presente en cada célula del organismo. Es esencial para el metabolismo energético, la reparación del ADN y la regulación del envejecimiento celular."
  },
  {
    "id": "70",
    "title": "NeuroMaxide",
    "slug": "neuromaxide",
    "price": 780000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/neuromaxide_perfect_ai_v1_1785075353.jpg",
    "excerpt": "SEMAX es un neuropéptido sintético derivado del fragmento de la hormona adrenocorticotrópica (ACTH). Se investiga por sus efectos neuroprotectores, neurotróficos y potenciadores de la función cognitiva."
  },
  {
    "id": "72",
    "title": "NeuroVascX",
    "slug": "neurovascx",
    "price": 900000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/phys_72_1784959688.jpg",
    "excerpt": "ARA-290, también conocido como Cibinetida, es un péptido sintético derivado de la región protectora de la eritropoyetina (EPO). Se investiga por sus propiedades neuroprotectoras, antiinflamatorias y de reparación tisular."
  },
  {
    "id": "74",
    "title": "Nocturnax",
    "slug": "nocturnax",
    "price": 1400000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/nocturnax_perfect_ai_v1_1785075353.jpg",
    "excerpt": "La melatonina es una hormona indolamina endógena sintetizada principalmente en la glándula pineal. Regula el ritmo circadiano sueño-vigilia y posee propiedades antioxidantes y neuroprotectoras."
  },
  {
    "id": "76",
    "title": "Noctyline",
    "slug": "noctyline",
    "price": 500000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/noctyline_perfect_ai_v1_1785075353.jpg",
    "excerpt": "El Péptido Inductor del Sueño Delta (DSIP) es un neuropéptido de origen natural asociado con la regulación del sueño, la respuesta al estrés y la modulación neuroendocrina."
  },
  {
    "id": "78",
    "title": "Oxyluxe",
    "slug": "oxyluxe",
    "price": 1200000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/oxyluxe_perfect_ai_v1_1785075353.jpg",
    "excerpt": "La oxitocina es un neuropéptido y hormona de origen natural ampliamente estudiada por su papel en la vinculación social, el comportamiento maternal, la confianza interpersonal y la regulación del estrés."
  },
  {
    "id": "80",
    "title": "Retatrutide",
    "slug": "retatrutide",
    "price": 1100000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/r3elite_perfect_ai_v2_1784993894.jpg",
    "excerpt": "Retatrutida es un polipéptido de investigación avanzado y triple agonista para los receptores de GIP, GLP-1 y glucagón. Se investiga como una de las moléculas más prometedoras en el manejo del peso y el metabolismo."
  },
  {
    "id": "82",
    "title": "Selenyx",
    "slug": "selenyx",
    "price": 960000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/neurobalance_perfect_ai_v1_1784989820.jpg",
    "excerpt": "Selank es un neuropéptido sintético derivado del péptido inmune endógeno tuftsin. Se investiga por sus propiedades ansiolíticas, neuroprotectoras y de mejora cognitiva sin efectos sedantes significativos."
  },
  {
    "id": "84",
    "title": "Semaglutide",
    "slug": "semaglutide",
    "price": 900000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/semaglutide_master_ai_v3_1785003215.jpg",
    "excerpt": "Semaglutida es un péptido sintético y agonista del receptor de GLP-1 (péptido similar al glucagón tipo 1). Se investiga extensamente por su eficacia en el control del peso corporal y la regulación glucémica."
  },
  {
    "id": "86",
    "title": "SomatoNova",
    "slug": "somatonova",
    "price": 1400000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/somatonova_perfect_ai_v2_1784993894.jpg",
    "excerpt": "SomatoNova™ HGH es una forma recombinante de la hormona de crecimiento humana (somatotropina) estudiada extensamente por sus efectos en el crecimiento celular, la composición corporal y el metabolismo."
  },
  {
    "id": "88",
    "title": "TesaLean",
    "slug": "tesalean",
    "price": 800000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/tesalean_perfect_ai_v1_1784989820.jpg",
    "excerpt": "Tesamorelina es un análogo sintético de la hormona liberadora de hormona de crecimiento (GHRH) diseñado para estimular la secreción de GH de forma fisiológica y selectiva."
  },
  {
    "id": "90",
    "title": "ThymaRegen",
    "slug": "thymaregen",
    "price": 840000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/thymaregen_perfect_ai_v1_1784989820.jpg",
    "excerpt": "ThymaRegen™ (Timalina) es un péptido tímico sintético formulado para investigación avanzada en inmunomodulación, regeneración del timo y restauración de la función inmune asociada al envejecimiento."
  },
  {
    "id": "92",
    "title": "Tirzepatide",
    "slug": "tirzepatide",
    "price": 900000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/monttide_perfect_ai_v2_1784993894.jpg",
    "excerpt": "Tirzepatida es un polipéptido sintético y doble agonista de los receptores GIP y GLP-1. Representa una nueva clase de terapias investigadas para el manejo del peso y el control metabólico."
  },
  {
    "id": "94",
    "title": "Vip-NeuroX",
    "slug": "vip-neurox",
    "price": 1100000,
    "image": "https://peptidossuizos.com/wp-content/uploads/2026/05/neurovascx_perfect_ai_v2_1784993894.jpg",
    "excerpt": "VIP-NeuroX™ es una formulación de alta pureza del Péptido Intestinal Vasoactivo (VIP), desarrollada para investigación avanzada en neuroprotección, regulación inmune e inflamación sistémica."
  }
];

const SVGS = {
    flame: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>',
    shield: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>',
    muscle: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" y1="2" x2="12" y2="12"/></svg>',
    sparkle: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3m0 12v3M3 12h3m12 0h3m-3.5-6.5l-2 2m-7 7l-2 2m11 0l-2-2m-7-7l-2-2"/></svg>',
    dna: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 15c6.667-6 13.333 0 20-6"/><path d="M2 9c6.667 6 13.333 0 20 6"/><path d="M9 22c0-6 6-12 6-18"/><path d="M9 2c0 6 6 12 6 18"/></svg>',
    scale: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 16l3-8 3 8a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zM2 16l3-8 3 8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2z"/><line x1="12" y1="3" x2="12" y2="21"/><path d="M7 12h10"/></svg>',
    bolt: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
    brain: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
    moon: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>',
    heart: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
    cart: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
    tag: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00a8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>'
};

const CATEGORY_META = {
    'all': {
        tag: 'EFECTIVIDAD Y PUREZA CLÍNICA SUIZA',
        title: 'Catálogo General de Péptidos',
        desc: 'Explora todas nuestras 40 fórmulas con certificación HPLC ≥99%. Potencia tus resultados con biotecnología de grado médico y máxima efectividad.'
    },
    'Pérdida de Peso': {
        tag: 'MÁXIMA EFECTIVIDAD METABÓLICA',
        title: 'Fórmulas de Élite para Pérdida de Peso',
        desc: 'El estándar de oro en ciencia metabólica. Control absoluto del apetito, saciedad prolongada y aceleración celular para transformar tu composición corporal de forma segura.'
    },
    'Masa Muscular': {
        tag: 'HIPERTROFIA & REGENERACIÓN TISULAR',
        title: 'Fórmulas para Masa Muscular & Fuerza',
        desc: 'Maximiza la síntesis proteica, acelera la reparación de ligamentos y estimula la liberación natural de hormona de crecimiento.'
    },
    'Salud Celular': {
        tag: 'OPTIMIZACIÓN MITOCONDRIAL & ENERGÍA',
        title: 'Fórmulas para Salud Celular & Energía',
        desc: 'Recarga tus niveles de ATP, activa sirtuinas antiedad y restaura la vitalidad mitocondrial profunda.'
    },
    'Longevidad & Piel': {
        tag: 'REJUVENECIMIENTO & COLÁGENO PROFUNDO',
        title: 'Fórmulas de Longevidad, Piel & Colágeno',
        desc: 'Revierte el envejecimiento cutáneo, estimula colágeno I/III y protege tus telómeros celulares.'
    },
    'Sueño & Bienestar': {
        tag: 'DESCANSO PROFUNDO REM & VITALIDAD',
        title: 'Fórmulas para Sueño, Descanso & Bienestar',
        desc: 'Induce un descanso nocturno profundo en fase REM, regula ritmos circadianos y optimiza la vitalidad diaria.'
    }
};

const PRODUCT_DICT = {
    // 1. PÉRDIDA DE PESO (9 PRODUCTOS)
    'semaglutide': { cat: 'Pérdida de Peso', b1: 'Control de Saciedad GLP-1', b2: 'Vaciado Gástrico y Definición', icon1: SVGS.scale, icon2: SVGS.brain, doses: ['5 mg', '10 mg'], priority: 1 },
    'tirzepatide': { cat: 'Pérdida de Peso', b1: 'Doble Acción GLP-1 / GIP', b2: 'Reducción de Grasa Visceral', icon1: SVGS.scale, icon2: SVGS.flame, doses: ['10 mg', '30 mg', '60 mg'], priority: 2 },
    'retatrutide': { cat: 'Pérdida de Peso', b1: 'Triple Agonista GIP / GLP-1 / Glucagón', b2: 'Aceleración Calórica Rápida', icon1: SVGS.bolt, icon2: SVGS.flame, doses: ['10 mg', '20 mg'], priority: 3 },
    'aod-9604': { cat: 'Pérdida de Peso', b1: 'Fragmento hGH 177-191 Lipolítico', b2: 'Quema de Grasa Focalizada', icon1: SVGS.flame, icon2: SVGS.shield, doses: ['10 mg', '20 mg'], priority: 4 },
    'appetitex': { cat: 'Pérdida de Peso', b1: 'Análogo de Amilina', b2: 'Supresión del Apetito Vía Cerebral', icon1: SVGS.brain, icon2: SVGS.scale, doses: ['10 mg', '20 mg'], priority: 5 },
    'aicaburn': { cat: 'Pérdida de Peso', b1: 'Activador Enzimático AMPK', b2: 'Mayor Gasto Calórico en Reposo', icon1: SVGS.bolt, icon2: SVGS.muscle, doses: ['10 mg', '20 mg'], priority: 6 },
    'tesalean': { cat: 'Pérdida de Peso', b1: 'Secretagogo de GH Lipolítico', b2: 'Reducción de Grasa Abdominal', icon1: SVGS.brain, icon2: SVGS.flame, doses: ['5 mg', '10 mg'], priority: 7 },
    'lipoburn': { cat: 'Pérdida de Peso', b1: 'Fórmula Termogénica Combinada', b2: 'Movilización de Grasa Obstinada', icon1: SVGS.flame, icon2: SVGS.bolt, doses: ['10 mg', '20 mg'], priority: 8 },
    'lipolean': { cat: 'Pérdida de Peso', b1: 'Matriz Lipotrópica Metabólica', b2: 'Definición Corporal Acelerada', icon1: SVGS.scale, icon2: SVGS.flame, doses: ['10 mg', '20 mg'], priority: 9 },

    // 2. SUEÑO & BIENESTAR (6 PRODUCTOS)
    'nocturnax': { cat: 'Sueño & Bienestar', b1: 'Inducción de Sueño Profundo Delta', b2: 'Regulación del Ciclo Circadiano', icon1: SVGS.moon, icon2: SVGS.brain, doses: ['5 mg', '10 mg'], priority: 10 },
    'noctyline': { cat: 'Sueño & Bienestar', b1: 'Restauración de Fase REM Nocturna', b2: 'Descanso Reparador sin Ansiedad', icon1: SVGS.moon, icon2: SVGS.shield, doses: ['5 mg', '10 mg'], priority: 11 },
    'erosense': { cat: 'Sueño & Bienestar', b1: 'Bienestar Intimidad & Vigor', b2: 'Reducción de Estrés y Cortisol', icon1: SVGS.heart, icon2: SVGS.brain, doses: ['10 UI', '50 UI'], priority: 12 },
    'oxyluxe': { cat: 'Sueño & Bienestar', b1: 'Regulación Emocional y Conexión', b2: 'Calma Neural y Anti-Estrés', icon1: SVGS.heart, icon2: SVGS.shield, doses: ['10 UI', '50 UI'], priority: 13 },
    'bronzex': { cat: 'Sueño & Bienestar', b1: 'Melanogénesis Cutánea', b2: 'Pigmentación Natural y Bronceado', icon1: SVGS.sparkle, icon2: SVGS.shield, doses: ['10 mg'], priority: 14 },
    'lipovite': { cat: 'Sueño & Bienestar', b1: 'Complejo B y Aminoácidos de Energía', b2: 'Vitalidad Diaria y Buen Ánimo', icon1: SVGS.bolt, icon2: SVGS.heart, doses: ['10 ml', '30 ml'], priority: 15 },

    // 3. MASA MUSCULAR & REGENERACIÓN (7 PRODUCTOS)
    'bpc-157 + tb-500': { cat: 'Masa Muscular', b1: 'Doble Péptido de Regeneración', b2: 'Reparación de Tendones y Fibras', icon1: SVGS.shield, icon2: SVGS.muscle, doses: ['10 mg'], priority: 20 },
    'bpc-healix': { cat: 'Masa Muscular', b1: 'Protección Gastro-Tisular Avanzada', b2: 'Recuperación Acelerada Muscular', icon1: SVGS.shield, icon2: SVGS.muscle, doses: ['5 mg', '10 mg'], priority: 21 },
    'igf-novax': { cat: 'Masa Muscular', b1: 'Factor de Crecimiento Insulínico', b2: 'Hipertrofia Muscular Magra', icon1: SVGS.muscle, icon2: SVGS.dna, doses: ['1 mg', '2 mg'], priority: 22 },
    'growthprime': { cat: 'Masa Muscular', b1: 'Estimulación de Síntesis Proteica', b2: 'Aumento de Fuerza y Rendimiento', icon1: SVGS.muscle, icon2: SVGS.bolt, doses: ['5 mg', '10 mg'], priority: 23 },
    'ipagrow': { cat: 'Masa Muscular', b1: 'Secretagogo de Pulso GH Limpio', b2: 'Masa Muscular sin Retención', icon1: SVGS.muscle, icon2: SVGS.shield, doses: ['5 mg', '10 mg'], priority: 24 },
    'ghr-prime': { cat: 'Masa Muscular', b1: 'Liberador de Hormona de Crecimiento', b2: 'Recuperación Post-Entrenamiento', icon1: SVGS.muscle, icon2: SVGS.dna, doses: ['5 mg', '10 mg'], priority: 25 },
    'somatonova': { cat: 'Masa Muscular', b1: 'Optimización Somatotrópica', b2: 'Desarrollo Muscular Avanzado', icon1: SVGS.muscle, icon2: SVGS.bolt, doses: ['5 mg', '10 mg'], priority: 26 },

    // 4. LONGEVIDAD & PIEL (9 PRODUCTOS)
    'epitalon': { cat: 'Longevidad & Piel', b1: 'Activador de Telomerasa Epifisaria', b2: 'Rejuvenecimiento Celular Anti-Edad', icon1: SVGS.dna, icon2: SVGS.sparkle, doses: ['10 mg', '50 mg'], priority: 30 },
    'dermacooper': { cat: 'Longevidad & Piel', b1: 'Tripéptido de Cobre GHK-Cu', b2: 'Firmeza Cutánea y Colágeno I/III', icon1: SVGS.sparkle, icon2: SVGS.shield, doses: ['10 mg', '50 mg'], priority: 31 },
    'botulift': { cat: 'Longevidad & Piel', b1: 'Efecto Tensor y Suavizado Arrugas', b2: 'Relajación de Líneas de Expresión', icon1: SVGS.sparkle, icon2: SVGS.shield, doses: ['10 mg', '50 mg'], priority: 32 },
    'myoglow': { cat: 'Longevidad & Piel', b1: 'Radiancia Cutánea e Hidratación', b2: 'Renovación Celular de la Piel', icon1: SVGS.sparkle, icon2: SVGS.dna, doses: ['10 mg', '50 mg'], priority: 33 },
    'dermakpv': { cat: 'Longevidad & Piel', b1: 'Péptido Antiinflamatorio Cutáneo', b2: 'Calma y Reparación de la Dermis', icon1: SVGS.shield, icon2: SVGS.sparkle, doses: ['10 mg'], priority: 34 },
    'klowxtreme': { cat: 'Longevidad & Piel', b1: 'Nutrición Bioactiva Dermis', b2: 'Elasticidad y Tono Cutáneo', icon1: SVGS.sparkle, icon2: SVGS.dna, doses: ['10 mg', '50 mg'], priority: 35 },
    'longevitymax': { cat: 'Longevidad & Piel', b1: 'Protección Telomérica Extendida', b2: 'Longevidad y Salud Genómica', icon1: SVGS.dna, icon2: SVGS.shield, doses: ['10 mg', '50 mg'], priority: 36 },
    'thymaregen': { cat: 'Longevidad & Piel', b1: 'Restauración Tímica e Inmunológica', b2: 'Rejuvenecimiento Sistema Inmune', icon1: SVGS.shield, icon2: SVGS.dna, doses: ['10 mg'], priority: 37 },
    'selenyx': { cat: 'Longevidad & Piel', b1: 'Protección Antioxidante Celular', b2: 'Neutralización de Radicales Libres', icon1: SVGS.shield, icon2: SVGS.sparkle, doses: ['10 mg'], priority: 38 },

    // 5. SALUD CELULAR & ENERGÍA (9 PRODUCTOS)
    'nad+': { cat: 'Salud Celular', b1: 'Recarga Coenzima ATP Mitocondrial', b2: 'Energía Celular y Enfoque Mental', icon1: SVGS.bolt, icon2: SVGS.dna, doses: ['500 mg', '1000 mg'], priority: 40 },
    'neuromaxide': { cat: 'Salud Celular', b1: 'Optimización Nootrópica Neuroquímica', b2: 'Memoria, Enfoque y Claridad', icon1: SVGS.brain, icon2: SVGS.bolt, doses: ['10 mg', '30 mg'], priority: 41 },
    'neurovascx': { cat: 'Salud Celular', b1: 'Salud Neurovascular y Circulación', b2: 'Oxigenación Cerebral Profunda', icon1: SVGS.brain, icon2: SVGS.shield, doses: ['10 mg'], priority: 42 },
    'glutapurex': { cat: 'Salud Celular', b1: 'Glutatión Puro Desintoxicante', b2: 'Limpieza Hepática y Antioxidante', icon1: SVGS.shield, icon2: SVGS.bolt, doses: ['600 mg', '1200 mg'], priority: 43 },
    'immunothyx': { cat: 'Salud Celular', b1: 'Modulación Inmunológica Celular', b2: 'Defensas y Resistencia Viral', icon1: SVGS.shield, icon2: SVGS.dna, doses: ['10 mg'], priority: 44 },
    'fertinova': { cat: 'Salud Celular', b1: 'Optimización Hormonal Reproductiva', b2: 'Vitalidad Celular Fértil', icon1: SVGS.dna, icon2: SVGS.heart, doses: ['10 mg'], priority: 45 },
    'gonadomax': { cat: 'Salud Celular', b1: 'Soporte del Eje Gonadal', b2: 'Equilibrio Hormonal Integral', icon1: SVGS.heart, icon2: SVGS.shield, doses: ['5000 UI', '10000 UI'], priority: 46 },
    'vip-neurox': { cat: 'Salud Celular', b1: 'Péptido Vasoactivo Neuroprotector', b2: 'Protección Neuronal Avanzada', icon1: SVGS.brain, icon2: SVGS.dna, doses: ['10 mg'], priority: 47 },
    'agua bacteriostática': { cat: 'Salud Celular', b1: 'Diluyente Estéril Conservado', b2: 'Reconstitución Segura de Péptidos', icon1: SVGS.shield, icon2: SVGS.sparkle, doses: ['10 ml', '30 ml'], priority: 48 }
};

function buildProductModel(prod) {
    const key = prod.title.trim().toLowerCase();
    const match = PRODUCT_DICT[key];

    let cat = 'Salud Celular';
    let icon1 = SVGS.dna;
    let icon2 = SVGS.shield;
    let b1 = 'Salud y Vitalidad Celular';
    let b2 = 'Bienestar y Rejuvenecimiento';
    let doses = ['10 mg', '20 mg'];
    let priority = 100;

    if (match) {
        cat = match.cat;
        icon1 = match.icon1;
        icon2 = match.icon2;
        b1 = match.b1;
        b2 = match.b2;
        doses = match.doses;
        priority = match.priority;
    }

    const qtyTiers = [
        { label: '1 Unidad', qty: 1, discount: 0 },
        { label: '2 Unidades (10% OFF)', qty: 2, discount: 0.10 },
        { label: '3 Unidades (20% OFF)', qty: 3, discount: 0.20 },
        { label: '4+ Unidades (25% OFF)', qty: 4, discount: 0.25 }
    ];

    return {
        ...prod,
        category: cat,
        icon1: icon1,
        icon2: icon2,
        benefit1: b1,
        benefit2: b2,
        purity: 'HPLC ≥99%',
        doses: doses,
        qtyTiers: qtyTiers,
        selectedDoseIdx: 0,
        selectedQtyIdx: 0,
        priority: priority
    };
}

const catalogDataset = rawDbProducts.map(buildProductModel).sort((a, b) => a.priority - b.priority);

let currentFilteredProducts = [...catalogDataset];
let displayedCount = 12;
let activeCategory = 'all';

function formatCOP(num) {
    return '$ ' + Math.round(num).toLocaleString('es-CO');
}

function filterCatalog(category, btnElem) {
    activeCategory = category;

    const filterBtns = document.querySelectorAll('.cat-filter-btn');
    filterBtns.forEach(b => b.classList.remove('active'));
    if (btnElem) btnElem.classList.add('active');

    const meta = CATEGORY_META[category] || CATEGORY_META['all'];
    const secTag = document.getElementById('catalogSecTag');
    const secTitle = document.getElementById('catalogSecTitle');
    const secDesc = document.getElementById('catalogSecDesc');

    if (secTag) secTag.innerText = meta.tag;
    if (secTitle) secTitle.innerText = meta.title;
    if (secDesc) secDesc.innerText = meta.desc;

    if (category === 'all') {
        currentFilteredProducts = [...catalogDataset];
    } else {
        currentFilteredProducts = catalogDataset.filter(item => item.category === category);
    }

    displayedCount = 12;
    renderCatalogGrid();
}

function renderCatalogGrid() {
    const gridContainer = document.getElementById('mainCatalogGrid');
    if (!gridContainer) return;

    const visibleItems = currentFilteredProducts.slice(0, displayedCount);

    let html = '';
    visibleItems.forEach(prod => {
        html += `
        <div class="prod-card-luxury">
            <div class="card-top-bar">
                <span class="card-cat-badge">${prod.category}</span>
                <span class="card-purity-badge">${prod.purity}</span>
            </div>

            <div class="card-image-wrapper">
                <a href="/producto/${prod.slug}/" style="display:block;width:100%;height:100%;text-align:center;">
                    <img src="${prod.image}" alt="${prod.title}" loading="lazy" decoding="async" class="card-prod-img">
                </a>
            </div>

            <div class="card-details-box">
                <h3 class="card-prod-title"><a href="/producto/${prod.slug}/" style="color:inherit;text-decoration:none;">${prod.title}</a></h3>
                
                <div class="card-benefits-list">
                    <div class="benefit-item-row">
                        ${prod.icon1}
                        <span>${prod.benefit1}</span>
                    </div>
                    <div class="benefit-item-row">
                        ${prod.icon2}
                        <span>${prod.benefit2}</span>
                    </div>
                </div>

                <div class="selector-section">
                    <span class="selector-label">Concentración / Tamaño:</span>
                    <div class="selector-pills-flex">
                        ${prod.doses.map((d, idx) => `
                            <button type="button" class="size-pill ${idx === prod.selectedDoseIdx ? 'active' : ''}" 
                                onclick="selectDoseSize('${prod.id}', ${idx}, this)">
                                ${d}
                            </button>
                        `).join('')}
                    </div>
                </div>

                <div class="selector-section">
                    <span class="selector-label">Cantidad & Descuento por Volumen:</span>
                    <div class="selector-pills-flex">
                        ${prod.qtyTiers.map((t, idx) => `
                            <button type="button" class="qty-pill ${idx === prod.selectedQtyIdx ? 'active' : ''}" 
                                onclick="selectQtyTier('${prod.id}', ${idx}, this)">
                                ${t.label}
                            </button>
                        `).join('')}
                    </div>
                </div>

                <div class="savings-banner" id="savings-${prod.id}" style="display:none;"></div>

                <div class="card-footer-action">
                    <div class="card-price-container">
                        <span class="card-reg-price" id="strike-${prod.id}"></span>
                        <span class="card-main-price" id="price-${prod.id}"></span>
                    </div>

                    <div class="card-btn-group">
                        <button type="button" class="btn-add-cart" onclick="addToCartItem('${prod.id}')">
                            ${SVGS.cart} Carrito
                        </button>
                        <a href="#" id="ws-${prod.id}" target="_blank" class="btn-ws-order" title="Pedir por WhatsApp">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        `;
    });

    gridContainer.innerHTML = html;

    visibleItems.forEach(prod => {
        updateCardCalculations(prod.id);
    });

    const loadMoreBtn = document.getElementById('loadMoreCatalogBtn');
    if (loadMoreBtn) {
        if (displayedCount >= currentFilteredProducts.length) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'inline-flex';
        }
    }
}

function loadMoreProducts() {
    displayedCount += 12;
    renderCatalogGrid();
}

function selectDoseSize(prodId, doseIdx, btnElem) {
    const prod = catalogDataset.find(p => p.id === prodId);
    if (!prod) return;

    prod.selectedDoseIdx = doseIdx;

    const parent = btnElem.parentElement;
    parent.querySelectorAll('.size-pill').forEach(b => b.classList.remove('active'));
    btnElem.classList.add('active');

    updateCardCalculations(prodId);
}

function selectQtyTier(prodId, qtyIdx, btnElem) {
    const prod = catalogDataset.find(p => p.id === prodId);
    if (!prod) return;

    prod.selectedQtyIdx = qtyIdx;

    const parent = btnElem.parentElement;
    parent.querySelectorAll('.qty-pill').forEach(b => b.classList.remove('active'));
    btnElem.classList.add('active');

    updateCardCalculations(prodId);
}


function parseDoseNumeric(doseStr) {
    if (!doseStr) return 10;
    const match = doseStr.match(/(\d+)/);
    return match ? parseFloat(match[1]) : 10;
}

function updateCardCalculations(prodId) {
    const prod = catalogDataset.find(p => p.id === prodId);
    if (!prod) return;

    const doseIdx = prod.selectedDoseIdx || 0;
    const qtyIdx = prod.selectedQtyIdx || 0;

    const selectedDoseStr = prod.doses[doseIdx] || prod.doses[0];
    const selectedQtyObj = prod.qtyTiers[qtyIdx] || prod.qtyTiers[0];

    // Base price for dose 0
    const baseDoseVal = parseDoseNumeric(prod.doses[0]);
    const currentDoseVal = parseDoseNumeric(selectedDoseStr);

    let doseMultiplier = 1.0;
    if (baseDoseVal > 0 && currentDoseVal > baseDoseVal) {
        const ratio = currentDoseVal / baseDoseVal;
        // Apply 25% bulk dose efficiency discount
        doseMultiplier = 1.0 + (ratio - 1) * 0.75;
    }

    const baseUnitPriceForDose = Math.round(prod.price * doseMultiplier);
    const totalQty = selectedQtyObj.qty;
    const discountRate = selectedQtyObj.discount;

    const rawSubtotal = baseUnitPriceForDose * totalQty;
    const finalPrice = Math.round(rawSubtotal * (1 - discountRate));
    const raisedStrikethroughPrice = Math.round(rawSubtotal * 1.30);

    const priceElem = document.getElementById(`price-${prodId}`);
    const strikeElem = document.getElementById(`strike-${prodId}`);
    const savingsElem = document.getElementById(`savings-${prodId}`);
    const wsBtn = document.getElementById(`ws-${prodId}`);

    if (priceElem) priceElem.innerText = formatCOP(finalPrice);
    if (strikeElem) strikeElem.innerText = formatCOP(raisedStrikethroughPrice);

    if (savingsElem) {
        if (discountRate > 0) {
            const savingsCOP = rawSubtotal - finalPrice;
            savingsElem.innerHTML = `${SVGS.tag} <span>¡Ahorras ${formatCOP(savingsCOP)} (${Math.round(discountRate * 100)}% OFF por cantidad)!</span>`;
            savingsElem.style.display = 'flex';
        } else {
            savingsElem.style.display = 'none';
            savingsElem.innerHTML = '';
        }
    }

    if (wsBtn) {
        const msg = encodeURIComponent(`Hola, quiero pedir ${prod.title} (${selectedDoseStr} - ${selectedQtyObj.label}) por ${formatCOP(finalPrice)} COP con envío gratis en Colombia.`);
        wsBtn.href = `https://wa.me/573189163091?text=${msg}`;
    }
}


// CART SYSTEM INTEGRATION
let cartState = [];

function addToCartItem(prodId) {
    const prod = catalogDataset.find(p => p.id === prodId);
    if (!prod) return;

    const selectedQtyObj = prod.qtyTiers[prod.selectedQtyIdx || 0];
    const qty = selectedQtyObj ? (selectedQtyObj.qty || 1) : 1;

    // OPTIMISTIC UI: Immediately update badges before server responds
    try {
      var currentCount = parseInt(localStorage.getItem('sp_cart_count') || '0');
      var newCount = currentCount + qty;
      localStorage.setItem('sp_cart_count', newCount);
      document.querySelectorAll('#cartCount, .cart-count, .floating-cart-count, #floatingCartCount').forEach(function(el) {
        el.textContent = newCount;
        el.style.display = 'flex';
      });
      // Optimistic total
      var currentTotal = parseInt(localStorage.getItem('sp_cart_total_raw') || '0');
      var price = prod.price || 0;
      var discountRate = selectedQtyObj ? (selectedQtyObj.discount || 0) : 0;
      var addedValue = Math.round(price * qty * (1 - discountRate));
      var newTotal = currentTotal + addedValue;
      localStorage.setItem('sp_cart_total_raw', newTotal);
      var formattedTotal = '$ ' + newTotal.toLocaleString('es-CO');
      document.querySelectorAll('#floatingCartSubtotal, #cartTotalAmount, .cart-total-amount').forEach(function(el) {
        el.textContent = formattedTotal;
      });
    } catch(e) {}

    // Send real AJAX request to WooCommerce
    fetch('/?wc-ajax=add_to_cart', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'product_id=' + encodeURIComponent(prodId) + '&quantity=' + encodeURIComponent(qty)
    })
    .then(res => res.json())
    .then(data => {
        if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
            window.spUpdateCartDrawerFromAJAX();
        }
        openCartSidebarDrawer();
    })
    .catch(err => {
        console.error('Add to cart AJAX error', err);
        if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
            window.spUpdateCartDrawerFromAJAX();
        }
        openCartSidebarDrawer();
    });
}

function updateCartUI() {
    if (typeof window.spUpdateCartDrawerFromAJAX === 'function') {
        window.spUpdateCartDrawerFromAJAX();
    }
}

function removeFromCart(idx) {
    cartState.splice(idx, 1);
    updateCartUI();
}

function openCartSidebarDrawer() {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('overlay');
    if (sidebar) sidebar.classList.add('open');
    if (overlay) overlay.classList.add('active');
    document.body.classList.add('cart-drawer-open');
}

function closeCartSidebarDrawer() {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('overlay');
    if (sidebar) sidebar.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
    document.body.classList.remove('cart-drawer-open');
}

/* Automatic scroll disabled: products load only on button click */

document.addEventListener('DOMContentLoaded', () => {
    renderCatalogGrid();

    const cartToggles = document.querySelectorAll('#cartToggle, #floatingCartWidget, .open-cart-btn');
    cartToggles.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openCartSidebarDrawer();
        });
    });

    const closeBtn = document.getElementById('cartCloseBtn');
    const overlay = document.getElementById('overlay');
    if (closeBtn) closeBtn.addEventListener('click', closeCartSidebarDrawer);
    if (overlay) overlay.addEventListener('click', closeCartSidebarDrawer);
});
