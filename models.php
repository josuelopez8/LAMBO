<?php
session_start();
include 'header.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$categories = [
    'Superdeportivos' => [
        [
            'name' => 'Aventador SVJ',
            'image' => 'imagenes/svj.jpg',
            'specs' => [
                'Motor' => 'V12 6.5L',
                'Potencia' => '770 HP',
                'Velocidad máxima' => '350 km/h',
                'Aceleración 0-100' => '2.8 seg',
                'Peso' => '1,525 kg',
                'Precio' => '$517,000'
            ],
            'description' => 'La versión más extrema del Aventador con aerodinámica activa ALA 2.0'
        ],
        [
            'name' => 'Aventador Ultimae',
            'image' => 'imagenes/ultimae.jpg',
            'specs' => [
                'Motor' => 'V12 6.5L',
                'Potencia' => '780 HP',
                'Velocidad máxima' => '355 km/h',
                'Aceleración 0-100' => '2.8 seg',
                'Peso' => '1,550 kg',
                'Precio' => '$498,000'
            ],
            'description' => 'El último V12 de Lamborghini, una obra maestra de ingeniería'
        ],
        [
            'name' => 'Aventador SVJ Roadster',
            'image' => 'imagenes/svjr.jpg',
            'specs' => [
                'Motor' => 'V12 6.5L',
                'Potencia' => '770 HP',
                'Velocidad máxima' => '350 km/h',
                'Techos' => 'Desmontable de fibra de carbono',
                'Peso' => '1,575 kg',
                'Precio' => '$573,000'
            ],
            'description' => 'Edición descapotable del SVJ con sonido puro V12'
        ],
        
        [
            'name' => 'Huracán STO',
            'image' => 'imagenes/sto.jpg',
            'specs' => [
                'Motor' => 'V10 5.2L',
                'Potencia' => '640 HP',
                'Peso' => '1,339 kg',
                'Aerodinámica' => 'Ala fija y difusor racing',
                '0-100 km/h' => '3.0 seg',
                'Precio' => '€327,000'
            ],
            'description' => 'Versión track-focused inspirada en el Super Trofeo EVO'
        ],
        [
            'name' => 'Huracán Sterrato',
            'image' => 'imagenes/sterrato.jpg',
            'specs' => [
                'Motor' => 'V10 5.2L',
                'Potencia' => '610 HP',
                'Altura libre' => '47 mm adicionales',
                'Neumáticos' => 'All-terrain específicos',
                'Modo Rally' => 'Sistema de tracción especial',
                'Precio' => '$273,000'
            ],
            'description' => 'Primer superdeportivo todo terreno con motorización V10'
        ],
        [
            'name' => 'Huracán Performante',
            'image' => 'imagenes/performante.jpg',
            'specs' => [
                'Motor' => 'V10 5.2L',
                'Potencia' => '640 HP',
                'Peso' => '1,382 kg',
                'Materiales' => 'Forged Composites',
                '0-100 km/h' => '2.9 seg',
                'Precio' => '€274,000'
            ],
            'description' => 'La evolución radical del Huracán con ALA activa'
        ],
        [
            'name' => 'Huracán EVO Spyder',
            'image' => 'imagenes/evospyder.jpg',
            'specs' => [
                'Motor' => 'V10 5.2L',
                'Potencia' => '640 HP',
                'Cierre techo' => '17 segundos (máx 50 km/h)',
                'Peso' => '1,542 kg',
                'Sistema escape' => 'Titanio Sport',
                'Precio' => '€231,000'
            ],
            'description' => 'Versión descapotable con tecnología predictiva LDVI'
        ],
        [
            'name' => 'Revuelto',
            'image' => 'imagenes/revuelto.jpg',
            'specs' => [
                'Motor' => 'V12 Híbrido',
                'Potencia total' => '1,015 HP',
                'Batería' => '3.8 kWh',
                'Transmisión' => '8DCT + 3 motores eléctricos',
                '0-100 km/h' => '2.5 seg',
                'Precio' => '€510,000'
            ],
            'description' => 'El primer híbrido enchufable de Lamborghini con tracción total'
        ]
    ],
    
    'Clásicos' => [
    [
        'name' => '350 GT',
        'image' => 'imagenes/350gt.jpg',
        'specs' => [
            'Año' => '1964-1966',
            'Motor' => 'V12 3.5L',
            'Potencia' => '280 HP',
            'Producción' => '120 unidades',
            'Velocidad máxima' => '254 km/h',
            'Característica' => 'Primer Lamborghini de producción'
        ],
        'description' => 'El modelo que inició la leyenda, diseñado por Carrozzeria Touring.'
    ],
    [
        'name' => 'Countach LP400',
        'image' => 'imagenes/countach.jpg',
        'specs' => [
            'Año' => '1974-1990',
            'Motor' => 'V12 4.0L',
            'Potencia' => '375 HP',
            'Diseñador' => 'Marcello Gandini',
            'Innovación' => 'Puertas de tijera',
            'Icono cultural' => 'Aparecido en Cannonball Run'
        ],
        'description' => 'El superdeportivo que definió el diseño radical de los años 80.'
    ],
    [
        'name' => 'Diablo VT',
        'image' => 'imagenes/diablo.jpg',
        'specs' => [
            'Año' => '1990-2001',
            'Motor' => 'V12 5.7L',
            'Potencia' => '492 HP',
            'Tracción' => 'Integral (primero en Lamborghini)',
            'Velocidad' => '325 km/h',
            'Edición especial' => 'SE30 Jota'
        ],
        'description' => 'El último V12 puramente mecánico antes de la era electrónica.'
    ],
    [
        'name' => 'Murciélago LP640',
        'image' => 'imagenes/murcielago.jpg',
        'specs' => [
            'Año' => '2001-2010',
            'Motor' => 'V12 6.5L',
            'Potencia' => '640 HP',
            'Chasis' => 'Monocasco de carbono',
            'Aceleración' => '0-100 km/h en 3.4 seg',
            'Legado' => 'Nombre de un toro legendario'
        ],
        'description' => 'El último gran toro con tracción trasera y motor longitudinal.'
    ]
],
    'SUV' => [
    [
        'name' => 'Urus',
        'image' => 'imagenes/urus.jpg',
        'specs' => [
            'Motor' => 'V8 Biturbo 4.0L',
            'Potencia' => '650 HP',
            '0-100 km/h' => '3.6 seg',
            'Velocidad máxima' => '305 km/h',
            'Tracción' => 'Integral con diferencial Torsen',
            'Precio' => '$218,000'
        ],
        'description' => 'El primer Super SUV de alto rendimiento'
    ],
    [
        'name' => 'Urus Graphite Capsule',
        'image' => 'imagenes/urus_graphite.jpg',
        'specs' => [
            'Edición' => 'Limitada 2023',
            'Exterior' => 'Acabados mate especiales',
            'Interior' => 'Cuero Semi-Aniline',
            'Rines' => '23" Nath Nero Lucido',
            'Paquete' => 'Ad Personam exclusivo'
        ],
        'description' => 'Edición especial con detalles en fibra de carbono forjada'
    ]
],
    'Edición Limitada' => [
    [
        'name' => 'Sesto Elemento',
        'image' => 'imagenes/sesto.jpg',    
        'specs' => [
            'Año' => '2010',
            'Producción' => '20 unidades',
            'Motor' => 'V10 5.2L',
            'Peso' => '999 kg',
            'Materiales' => 'Fibra de carbono 100%',
            '0-100 km/h' => '2.5 seg'
        ],
        'description' => 'Obra maestra de ingeniería que prioriza la filosofía "menos es más"'
    ],
    [
        'name' => 'Veneno',
        'image' => 'imagenes/veneno.jpg',
        'specs' => [
            'Año' => '2013',
            'Producción' => '3 unidades',
            'Motor' => 'V12 6.5L',
            'Aerodinámica' => 'Coeficiente 1.001 Cd',
            'Velocidad' => '355 km/h',
            'Precio' => '€3.3 millones'
        ],
        'description' => 'Celebración del 50° aniversario con diseño de flujo de aire radical'
    ],
    [
        'name' => 'Centenario',
        'image' => 'imagenes/centenario.jpg',   
        'specs' => [
            'Año' => '2016',
            'Producción' => '40 unidades',
            'Motor' => 'V12 6.5L',
            'Potencia' => '770 HP',
            'Sistema' => 'ALA aerodinámica activa',
            'Homenaje' => '100 años de Ferruccio Lamborghini'
        ],
        'description' => 'Tributo tecnológico al fundador con chasis monocoque completo de carbono'
    ],
    [
        'name' => 'Reventón',
        'image' => 'imagenes/revento.jpg',
        'specs' => [
            'Año' => '2007',
            'Producción' => '20 unidades',
            'Base' => 'Murciélago LP640',
            'Instrumentación' => 'Pantalla digital fighter jet',
            'Diseño' => 'Inspirado en F-22 Raptor',
            'Valor actual' => '€1.8 millones'
        ],
        'description' => 'Primer hypercar de edición limitata de Lamborghini'
    ],
    [
        'name' => 'Essenza SCV12',
        'image' => 'imagenes/essenza.jpg',
        'specs' => [
            'Año' => '2020',
            'Producción' => '40 unidades',
            'Motor' => 'V12 6.5L',
            'Potencia' => '830 HP',
            'Chasis' => 'Monocasco de competición',
            'Destino' => 'Uso exclusivo en track'
        ],
        'description' => 'Máquina de carrera homologada para circuito'
    ],
    [
        'name' => 'Lamborghini SVJ 63',
        'image' => 'imagenes/svj63.jpg',
        'specs' => [
            'Produccion' => '63 unidades',
            'Motor' => 'V12 6.5L',
            'Potencia' => '770 HP',
            'Peso' => '1,525 kg',
            'Aceleracion' => '0-100 km/h en 2.8 seg',
            'Velocidad maxima' => '350 km/h',
            'Precio' => '€2,8 millones'
        ],
        'description' => 'Edicion especial por el 63° aniversaio de Lamborghini con elementos de carbono fojado y diseño unico'
    ],
    [
        'name' => 'SC18 Alston',
        'image' => 'imagenes/sc18.jpg',
        'specs' => [
            'Año' => '2018',
            'Producción' => '1 unidad',
            'Base' => 'Huracán GT3 Evo',
            'Aerodinámica' => 'Ala fija de 1,250 kg de carga',
            'Personalización' => 'Solicitud especial de cliente',
            'Valor' => '€5 millones+'
        ],
        'description' => 'One-off creado por Lamborghini Squadra Corse'
    ]
]];
?>

<style>
    :root {
        --primary: #FF0000;
        --dark: #1a1a1a;
        --light: #ffffff;
        --gold: #FFD700;
    }

    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f8f9fa;
    }

    .catalog-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 20px;
    }

    .category-card {
        background: var(--light);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
    }

    .category-header {
        background: linear-gradient(135deg, var(--dark), var(--primary));
        padding: 1.5rem;
        color: var(--light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .category-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .model-list {
        padding: 1.5rem;
        display: grid;
        gap: 1rem;
    }

    .model-item {
        padding: 1.25rem;
        background: var(--light);
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,0.05);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .model-item:hover {
        background: #fff5f5;
        box-shadow: 0 4px 15px rgba(255,0,0,0.1);
    }

    .model-name {
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .model-details {
        display: none;
        padding: 1.5rem;
        background: #f8f8f8;
        border-radius: 10px;
        margin-top: 1rem;
        animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .model-details.active {
        display: block;
    }

    .spec-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin: 1.5rem 0;
    }

    .spec-item {
        background: var(--light);
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .spec-item strong {
        display: block;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .car-image {
        width: 100%;
        max-width: 600px;
        border-radius: 12px;
        margin: 1rem auto;
        display: block;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .limited-badge {
        background: var(--gold);
        color: var(--dark);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .catalog-container {
            padding: 0 15px;
        }
        
        .category-header {
            padding: 1rem;
        }
        
        .model-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="catalog-container">
    <h1 style="text-align:center; margin-bottom:2rem; color:var(--dark);">Catálogo Premium Lamborghini</h1>
    
    <?php foreach ($categories as $category => $models): ?>
    <div class="category-card">
        <div class="category-header" onclick="toggleCategory(this)">
            <h2 class="category-title"><?= $category ?></h2>
            <?php if($category == 'Edición Limitada'): ?>
                <span class="badge limited-badge">EXCLUSIVO</span>
            <?php endif; ?>
        </div>
        
        <div class="model-list">
            <?php foreach ($models as $model): ?>
            <div class="model-item" onclick="toggleModel(this)">
                <div class="model-name">
                    <?php if($category == 'Edición Limitada'): ?>
                        <span style="color:var(--gold);">★</span>
                    <?php endif; ?>
                    <?= $model['name'] ?>
                </div>
                
                <div class="model-details">
                    <img src="<?= $model['image'] ?>" class="car-image" alt="<?= $model['name'] ?>">
                    <div class="spec-grid">
                        <?php foreach ($model['specs'] as $key => $value): ?>
                        <div class="spec-item">
                            <strong><?= $key ?></strong>
                            <span><?= $value ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <p style="text-align:center; font-size:1.1rem; color:var(--dark); line-height:1.6;">
                        <?= $model['description'] ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function toggleModel(element) {
    const details = element.querySelector('.model-details');
    const isActive = details.classList.contains('active');
    
    // Cerrar todos los detalles en la misma categoría
    element.parentElement.querySelectorAll('.model-details').forEach(d => {
        d.classList.remove('active');
    });
    
    // Alternar estado solo si no estaba activo
    if (!isActive) {
        details.classList.add('active');
    } else {
        details.classList.remove('active');
    }
}

function toggleCategory(element) {
    const categoryCard = element.parentElement;
    const modelList = categoryCard.querySelector('.model-list');
    modelList.style.display = modelList.style.display === 'none' ? 'grid' : 'none';
}
</script>

<?php include 'footer.php'; ?>