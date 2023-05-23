<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fredy Alexander',
            'last_name' => 'Xalín Aguín',
            'email' => 'alexanderxalinfredy@gmail.com',
            'password' => Hash::make('password')
        ]);

        $departments = [
            1 => 'Alta Verapaz',
            2 => 'Baja Verapaz',
            3 => 'Chimaltenango',
            4 => 'Chiquimula',
            5 => 'El Progreso',
            6 => 'Escuintla',
            7 => 'Guatemala',
            8 => 'Huehuetenango',
            9 => 'Izabal',
            10 => 'Jalapa',
            11 => 'Jutiapa',
            12 => 'Petén',
            13 => 'Quetzaltenango',
            14 => 'Quiché',
            15 => 'Retalhuleu',
            16 => 'Sacatepéquez',
            17 => 'San Marcos',
            18 => 'Santa Rosa',
            19 => 'Sololá',
            20 => 'Suchitepéquez',
            21 => 'Totonicapán',
            22 => 'Zacapa',
        ];

        foreach ($departments as $department_name) {
            $department = Department::create([
                'name' => $department_name
            ]);
            switch ($department->name) {
                case 'Alta Verapaz':
                    $municipalities_name = [
                        "Chahal",
                        "Chisec",
                        "Cobán",
                        "Fray Bartolomé de las Casas",
                        "Lanquín",
                        "Panzós",
                        "Raxruha",
                        "San Cristóbal Verapaz",
                        "San Juan Chamelco",
                        "San Pedro Carchá",
                        "Santa Cruz Verapaz",
                        "Senahú",
                        "Tactic",
                        "Tamahú",
                        "Tucurú",
                        "Santa María Cahabón",
                        "Santa Catarina La Tinta"
                    ];
                    break;
                case 'Baja Verapaz':
                    $municipalities_name = [
                        "Cubulco",
                        "Granados",
                        "Purulhá",
                        "Rabinal",
                        "Salamá",
                        "San Jerónimo",
                        "San Miguel Chicaj",
                        "Santa Cruz El Chol"
                    ];
                    break;
                case 'Chimaltenango':
                    $municipalities_name = [
                        "Acatenango",
                        "Chimaltenango",
                        "El Tejar",
                        "Parramos",
                        "Patzicía",
                        "Patzún",
                        "Pochuta",
                        "San Andrés Itzapa",
                        "San José Poaquil",
                        "San Juan Comalapa",
                        "San Martín Jilotepeque",
                        "Santa Apolonia",
                        "Santa Cruz Balanyá",
                        "Tecpán Guatemala",
                        "Yepocapa",
                        "Zaragoza"
                    ];
                    break;
                case 'Chiquimula':
                    $municipalities_name = [
                        "Camotán",
                        "Chiquimula",
                        "Concepción Las Minas",
                        "Esquipulas",
                        "Ipala",
                        "Jocotán",
                        "Olopa",
                        "Quezaltepeque",
                        "San Jacinto",
                        "San José La Arada",
                        "San Juan Ermita"
                    ];
                    break;
                case 'El Progreso':
                    $municipalities_name = [
                        "El Jícaro",
                        "Guastatoya",
                        "Morazán",
                        "San Agustín Acasaguastlán",
                        "San Antonio La Paz",
                        "San Cristóbal Acasaguastlán",
                        "Sanarate"
                    ];
                    break;
                case 'Escuintla':
                    $municipalities_name = [
                        "Escuintla",
                        "Guanagazapa",
                        "Iztapa",
                        "La Democracia",
                        "La Gomera",
                        "Masagua",
                        "Nueva Concepción",
                        "Palín",
                        "San José",
                        "San Vicente Pacaya",
                        "Santa Lucía Cotzumalguapa",
                        "Siquinalá",
                        "Tiquisate"
                    ];
                    break;
                case 'Guatemala':
                    $municipalities_name = [
                        "Amatitlán",
                        "Chinautla",
                        "Chuarrancho",
                        "Fraijanes",
                        "Guatemala City",
                        "Mixco",
                        "Palencia",
                        "Petapa",
                        "San José del Golfo",
                        "San José Pinula",
                        "San Juan Sacatepéquez",
                        "San Pedro Ayampuc",
                        "San Pedro Sacatepéquez",
                        "San Raymundo",
                        "Santa Catarina Pinula",
                        "Villa Canales"
                    ];
                    break;
                case 'Huehuetenango':
                    $municipalities_name = [
                        "Aguacatán",
                        "Chiantla",
                        "Colotenango",
                        "Concepción Huista",
                        "Cuilco",
                        "Huehuetenango",
                        "Ixtahuacán",
                        "Jacaltenango",
                        "La Democracia",
                        "La Libertad",
                        "Malacatancito",
                        "Nentón",
                        "San Antonio Huista",
                        "San Gaspar Ixchil",
                        "San Juan Atitán",
                        "San Juan Ixcoy",
                        "San Mateo Ixtatán",
                        "San Miguel Acatán",
                        "San Pedro Necta",
                        "San Rafael La Independencia",
                        "San Rafael Petzal",
                        "San Sebastián Coatán",
                        "San Sebastián Huehuetenango",
                        "Santa Ana Huista",
                        "Santa Bárbara",
                        "Santa Cruz Barillas",
                        "Santa Eulalia",
                        "Santiago Chimaltenango",
                        "Soloma",
                        "Tectitán",
                        "Todos Santos Cuchumatan"
                    ];
                    break;
                case 'Izabal':
                    $municipalities_name = [
                        "El Estor",
                        "Livingston",
                        "Los Amates",
                        "Morales",
                        "Puerto Barrios"
                    ];
                    break;
                case 'Jalapa':
                    $municipalities_name = [
                        "Jalapa",
                        "Mataquescuintla",
                        "Monjas",
                        "San Carlos Alzatate",
                        "San Luis Jilotepeque",
                        "San Manuel Chaparrón",
                        "San Pedro Pinula"
                    ];
                    break;
                case 'Jutiapa':
                    $municipalities_name = [
                        "Agua Blanca",
                        "Asunción Mita",
                        "Atescatempa",
                        "Comapa",
                        "Conguaco",
                        "El Adelanto",
                        "El Progreso",
                        "Jalpatagua",
                        "Jerez",
                        "Jutiapa",
                        "Moyuta",
                        "Pasaco",
                        "Quezada",
                        "San José Acatempa",
                        "Santa Catarina Mita",
                        "Yupiltepeque",
                        "Zapotitlán"
                    ];
                    break;
                case 'Petén':
                    $municipalities_name = [
                        "Dolores",
                        "Flores",
                        "La Libertad",
                        "Melchor de Mencos",
                        "Poptún",
                        "San Andrés",
                        "San Benito",
                        "San Francisco",
                        "San José",
                        "San Luis",
                        "Santa Ana",
                        "Sayaxché",
                        "Las Cruces"
                    ];
                    break;
                case 'Quetzaltenango':
                    $municipalities_name = [
                        "Almolonga",
                        "Cabricán",
                        "Cajolá",
                        "Cantel",
                        "Coatepeque",
                        "Colomba",
                        "Concepción Chiquirichapa",
                        "El Palmar",
                        "Flores Costa Cuca",
                        "Génova",
                        "Huitán",
                        "La Esperanza",
                        "Olintepeque",
                        "Ostuncalco",
                        "Palestina de Los Altos",
                        "Quetzaltenango",
                        "Salcajá",
                        "San Carlos Sija",
                        "San Francisco La Unión",
                        "San Martín Sacatepéquez",
                        "San Mateo",
                        "San Miguel Sigüilá",
                        "Sibilia",
                        "Zunil"
                    ];
                    break;
                case 'Quiché':
                    $municipalities_name = [
                        "Canillá",
                        "Chajul",
                        "Chicamán",
                        "Chiché",
                        "Chichicastenango",
                        "Chinique",
                        "Cunén",
                        "Ixcán",
                        "Joyabaj",
                        "Nebaj",
                        "Pachalum",
                        "Patzité",
                        "Sacapulas",
                        "San Andrés Sajcabajá",
                        "San Antonio Ilotenango",
                        "San Bartolomé Jocotenango",
                        "San Juan Cotzal",
                        "San Pedro Jocopilas",
                        "Santa Cruz del Quiché",
                        "Uspantán",
                        "Zacualpa"
                    ];
                    break;
                case 'Retalhuleu':
                    $municipalities_name = [
                        "Champerico",
                        "El Asintal",
                        "Nuevo San Carlos",
                        "Retalhuleu",
                        "San Andrés Villa Seca",
                        "San Felipe",
                        "San Martín Zapotitlán",
                        "San Sebastián",
                        "Santa Cruz Muluá"
                    ];
                    break;
                case 'Sacatepéquez':
                    $municipalities_name = [
                        "Alotenango",
                        "Antigua",
                        "Ciudad Vieja",
                        "Jocotenango",
                        "Magdalena Milpas Altas",
                        "Pastores",
                        "San Antonio Aguas Calientes",
                        "San Bartolomé Milpas Altas",
                        "San Lucas Sacatepéquez",
                        "San Miguel Dueñas",
                        "Santa Catarina Barahona",
                        "Santa Lucía Milpas Altas",
                        "Santa María de Jesús",
                        "Santiago Sacatepéquez",
                        "Santo Domingo Xenacoj",
                        "Sumpango"
                    ];
                    break;
                case 'San Marcos':
                    $municipalities_name = [
                        "Ayutla",
                        "Catarina",
                        "Comitancillo",
                        "Concepción Tutuapa",
                        "El Quetzal",
                        "El Rodeo",
                        "El Tumbador",
                        "Esquipulas Palo Gordo",
                        "Ixchiguan",
                        "La Reforma",
                        "Malacatán",
                        "Nuevo Progreso",
                        "Ocos",
                        "Pajapita",
                        "Río Blanco",
                        "San Antonio Sacatepéquez",
                        "San Cristóbal Cucho",
                        "San José Ojetenam",
                        "San Lorenzo",
                        "San Marcos",
                        "San Miguel Ixtahuacán",
                        "San Pablo",
                        "San Pedro Sacatepéquez",
                        "San Rafael Pie de La Cuesta",
                        "San Sibinal",
                        "Sipacapa",
                        "Tacaná",
                        "Tajumulco",
                        "Tejutla"
                    ];
                    break;
                case 'Santa Rosa':
                    $municipalities_name = [
                        "Barberena",
                        "Casillas",
                        "Chiquimulilla",
                        "Cuilapa",
                        "Guazacapán",
                        "Nueva Santa Rosa",
                        "Oratorio",
                        "Pueblo Nuevo Viñas",
                        "San Juan Tecuaco",
                        "San Rafael Las Flores",
                        "Santa Cruz Naranjo",
                        "Santa María Ixhuatán",
                        "Santa Rosa de Lima",
                        "Taxisco"
                    ];
                    break;
                case 'Sololá':
                    $municipalities_name = [
                        "Concepción",
                        "Nahualá",
                        "Panajachel",
                        "San Andrés Semetabaj",
                        "San Antonio Palopó",
                        "San José Chacaya",
                        "San Juan La Laguna",
                        "San Lucas Tolimán",
                        "San Marcos La Laguna",
                        "San Pablo La Laguna",
                        "San Pedro La Laguna",
                        "Santa Catarina Ixtahuacan",
                        "Santa Catarina Palopó",
                        "Santa Clara La Laguna",
                        "Santa Cruz La Laguna",
                        "Santa Lucía Utatlán",
                        "Santa María Visitación",
                        "Santiago Atitlán",
                        "Sololá"
                    ];
                    break;
                case 'Suchitepéquez':
                    $municipalities_name = [
                        "Chicacao",
                        "Cuyotenango",
                        "Mazatenango",
                        "Patulul",
                        "Pueblo Nuevo",
                        "Río Bravo",
                        "Samayac",
                        "San Antonio Suchitepéquez",
                        "San Bernardino",
                        "San Francisco Zapotitlán",
                        "San Gabriel",
                        "San José El Idolo",
                        "San Juan Bautista",
                        "San Lorenzo",
                        "San Miguel Panán",
                        "San Pablo Jocopilas",
                        "Santa Bárbara",
                        "Santo Domingo Suchitepequez",
                        "Santo Tomas La Unión",
                        "Zunilito"
                    ];
                    break;
                case 'Totonicapán':
                    $municipalities_name = [
                        "Momostenango",
                        "San Andrés Xecul",
                        "San Bartolo",
                        "San Cristóbal Totonicapán",
                        "San Francisco El Alto",
                        "Santa Lucía La Reforma",
                        "Santa María Chiquimula",
                        "Totonicapán"
                    ];
                    break;
                case 'Zacapa':
                    $municipalities_name = [
                        "Cabañas",
                        "Estanzuela",
                        "Gualán",
                        "Huité",
                        "La Unión",
                        "Río Hondo",
                        "San Diego",
                        "Teculután",
                        "Usumatlán",
                        "Zacapa"
                    ];
                    break;
                default:
                    $municipalities_name = [];
                    break;
            }
            foreach ($municipalities_name as $municipality_name) {
                $department->municipalities()->create([
                    'name' => $municipality_name,
                ]);
            }

        }

        \App\Models\Voter::factory(30)->create();
    }
}
