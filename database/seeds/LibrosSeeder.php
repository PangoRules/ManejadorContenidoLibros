<?php

use Illuminate\Database\Seeder;

class LibrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('libros') -> insert([
        	'nombre' => 'Coplas a la muerte de su padre',
            'descripcion' =>
            'Esta obra maestra del siglo XV hace una reflexión universal sobre la muerte, utilizando entre muchas características el tópico del "Ubi sunt".',
            'autor' => 'Jorge Manrique',
            'actualizado' => '1476-11-11',
            'aceptado' => true,
            'idcategoria' => '4',
            'user_iden' => '2',
        ]); 

        DB::table('libros') -> insert([
        	'nombre' => 'La elegía a Ramón Sijé',
            'descripcion' =>
            'Esta elegía la escribió Miguel Hernández como homenaje a la muerte de su amigo del alma Ramón Sijé, de quien se hallaba separado ideológicamente cuando le sobrevino la muerte de una forma prematura"no perdono a la muerte enamorada" y fulminante "se me ha muerto como del rayo" por una septicemia al corazón.',
            'autor' => 'Miguel Hernández',
            'actualizado' => '1476-11-11',
            'aceptado' => true,
            'idcategoria' => '4',
            'user_iden' => '2',
        ]);

        DB::table('libros') -> insert([
        	'nombre' => 'Vile Bodies',
            'descripcion' =>
            'Los periodistas y los predicadores, corredores y aristócratas, Ministros y hombre joven sobre la vida Town ... Corren por la vida y por las páginas de la novela en un torbellino de bolas, mascaradas y cenas – Victoriano, vaquero, Ruso, circo. Esto aparece por la voluntad del autor en Inglaterra un corto período entre las dos grandes guerras.',
            'autor' => 'Evelyn Waugh',
            'actualizado' => '1930-01-21',
            'aceptado' => true,
            'idcategoria' => '5',
            'user_iden' => '2',
        ]);

        DB::table('libros') -> insert([
        	'nombre' => 'Rebelión en la granja',
            'descripcion' =>
            'es una novela satírica del escritor británico George Orwell. Publicada en 1945, la obra es una fábula mordaz sobre cómo el régimen soviético de Iósif Stalin corrompe el socialismo. En la ficción de la novela un grupo de animales de una granja expulsa a los humanos tiranos y crea un sistema de gobierno propio que acaba convirtiéndose en otra tiranía brutal. Orwell, un socialista democrático y durante muchos años un miembro del Partido Laborista Independiente, fue un crítico de Stalin. La novela fue escrita durante la Segunda Guerra Mundial y, aunque publicada en 1945, no comenzó a ser conocida por el público hasta finales de los años 1950.',
            'autor' => 'George Orwell',
            'actualizado' => '1945-08-17',
            'aceptado' => true,
            'idcategoria' => '5',
            'user_iden' => '2',
        ]);

        DB::table('libros') -> insert([
        	'nombre' => 'A la soledad',
            'descripcion' =>
            'Oh Soledad amable,
Donde vive el sosiego
Que el hombre en otras partes busca en vano,
Su deseo insaciable
Aviva el mundo, y luego
Niega lo que ofrecía: ¡Infiel tirano!
Sólo aquí el pecho humano
Se engaña felizmente;
Le asusta del retiro la apariencia...',
            'autor' => 'Mariano Melgar',
            'actualizado' => '1790-08-10',
            'aceptado' => true,
            'idcategoria' => '6',
            'user_iden' => '2',
        ]);

            DB::table('libros') -> insert([
        	'nombre' => 'A la libertad',
            'descripcion' =>
            '¡Triste ley de la Tierra! Eternamente
todo el humano fruto
nacerá con dolor: nacerá todo
pagando al mal su mísero tributo;
y la semilla entre el infecto lodo
tenderá sus raíces,
tal como la razón sus claras lumbres...',
            'autor' => 'Vicente Wenceslao Querol',
            'actualizado' => '1835-08-17',
            'aceptado' => true,
            'idcategoria' => '6',
            'user_iden' => '2',
        ]);  

            DB::table('libros') -> insert([
        	'nombre' => 'Alicia en el país de las maravillas',
            'descripcion' =>
            'Las aventuras de Alicia en el país de las maravillas, comúnmente abreviado como Alicia en el país de las maravillas, es una novela de fantasía escrita por el matemático, lógico, fotógrafo y escritor británico Charles Lutwidge Dodgson, bajo el seudónimo de Lewis Carroll, publicada en 1865.',
            'autor' => 'Lewis Carroll',
            'actualizado' => '1865-11-25',
            'aceptado' => true,
            'idcategoria' => '7',
            'user_iden' => '2',
        ]);

            DB::table('libros') -> insert([
        	'nombre' => 'La bella durmiente',
            'descripcion' =>
            'Tras una larga esterilidad, un rey y una reina tienen una hija. Cuando la niña cumple un año de edad, invitan a un festejo en honor de la niña a siete hadas buenas y madrinas que, mediante encantamientos, le otorgan dones positivos. Pero entonces, irrumpe una bruja o hada malvada de un país vecino, a la que no pudieron invitar porque no había platos suficientes, y esta, ofendida, sentencia que el día que la princesa cumpla quince o dieciséis años se pinchará un dedo con el huso de una rueca y morirá. No obstante, una de las hadas buenas y madrinas invitadas que todavía no había otorgado su don a la princesa, mitiga la maldición de la bruja o hada malvada de manera que, cuando la princesa cumpla quince o dieciséis años, se pinchará el dedo con un huso de una rueca pero, en vez de morir, dormirá un siglo.',
            'autor' => 'Giambattista Basile, Charles Perrault y los hermanos Grimm',
            'actualizado' => '1840-10-07',
            'aceptado' => true,
            'idcategoria' => '7',
            'user_iden' => '2',
        ]);  

		DB::table('libros') -> insert([
		'nombre' => 'La metamorfosis',
		'descripcion' =>
		'La metamorfosis es un relato dividido en tres partes, donde se narra la transformación de Gregorio Samsa, un viajante de comercio de telas, en un monstruoso insecto, y el impacto que tendrá este acontecimiento no solo en su vida, sino en la de su familia.',
		'autor' => 'Lewis Carroll',
		'actualizado' => '1865-11-25',
		'aceptado' => true,
		'idcategoria' => '8',
		'user_iden' => '2',
		]);

		DB::table('libros') -> insert([
		'nombre' => 'Drácula',
		'descripcion' =>
		'La obra en sí comienza cuando Jonathan Harker, un joven abogado inglés de Londres comprometido con Wilhemina Murray (Mina) se encuentra en la ciudad de Bistritz y debe viajar a través del desfiladero del Borgo hasta el remoto castillo del conde Drácula, en los Montes Cárpatos de Transilvania, una de las regiones más lejanas de la Hungría de esa época, para cerrar unas ventas con él. Convirtiéndose durante un breve período de tiempo en huésped del conde, el joven inglés va descubriendo que la personalidad de Drácula es, cuanto menos, extraña: no se refleja en los espejos, no come nunca en su presencia y hace vida nocturna. Poco a poco va descubriendo que es un ser despreciable, ruin y despiadado que acabará convirtiéndole en un rehén en el propio castillo. En el mismo también viven tres jóvenes y bellas vampiresas que una noche seducen a Jonathan y están a punto de chuparle la sangre, cosa que evita la interrupción del conde. Para evitarlo, Drácula les entrega un niño que ha secuestrado para que se beban su sangre. La madre del bebé no tarda en llegar al castillo para reclamarlo, pero el conde ordena a los lobos que la devoren.',
		'autor' => 'Bram Stoker',
		'actualizado' => '1897-05-26',
		'aceptado' => true,
		'idcategoria' => '8',
		'user_iden' => '2',
		]);  

		DB::table('libros') -> insert([
		'nombre' => 'El cuerpo en el alba',
		'descripcion' =>
		'Ahora sí que ya os miro
cielo, tierra, sol, piedra,
como si viera mi propia carne.

Ya sólo me faltábais en ella
para verme completo,
hombre entero en el mundo
y padre sin semilla
de la presencia hermosa del futuro.

Antes, el alma vi nacer
y acudí a salvarla,
fiel tutor perseguido y doloroso,
pero siempre seguro
de mi mano y su aviso...',
		'autor' => 'Emilio Prados',
		'actualizado' => '1920-05-15',
		'aceptado' => true,
		'idcategoria' => '9',
		'user_iden' => '2',
		]);

		DB::table('libros') -> insert([
		'nombre' => 'Romeo y Julieta',
		'descripcion' =>
		'Se trata de una de las obras más populares del autor inglés y, junto a Hamlet y Macbeth, la que más veces ha sido representada. Aunque la historia forma parte de una larga tradición de romances trágicos que se remontan a la antigüedad, el argumento está basado en la traducción inglesa (The Tragical History of Romeus and Juliet, 1562) de un cuento italiano de Mateo Bandello, realizada por Arthur Brooke, que se basó en la traducción francesa hecha por Pierre Boaistuau en 1559. ',
		'autor' => 'William Shakespeare',
		'actualizado' => '1597-01-15',
		'aceptado' => true,
		'idcategoria' => '10',
		'user_iden' => '2',
		]);  

		DB::table('libros') -> insert([
		'nombre' => 'La divina comedia',
		'descripcion' =>
		'El poema se ordena en función del simbolismo del número tres, que evoca la Santísima Trinidad (el Padre, el Hijo y el Espíritu Santo), el equilibrio y la estabilidad, y el triángulo, las tres proposiciones que componen el silogismo, se sumaba al cuatro, que representaba los cuatro elementos: Tierra, aire, fuego y agua, dando como resultado el número siete, como siete son los pecados capitales. Finalmente, el Infierno está dividido en nueve círculos, el Purgatorio en siete y el Paraíso queda formado por nueve esferas que giran como los planetas en torno al sol.',
		'autor' => 'Dante Alighieri',
		'actualizado' => '1304-05-26',
		'aceptado' => true,
		'idcategoria' => '10',
		'user_iden' => '2',
		]);

		DB::table('libros') -> insert([
		'nombre' => 'La Traviata',
		'descripcion' =>
		'Composición de Giuseppe Verdi para un libreto escrito por Francesco Maria Piave. La historia está basada en la novela de Alexandre Dumas, La Dama de las Camelias. El título original de esta obra fue Violetta, en alusión al nombre de la protagonista y se estrenó oficialmente en 1853 en Venecia cosechando un rotundo fracaso. La Traviata cuenta la historia de una famosa cortesana parisiense llamada Alphonsine Plessis.',
		'autor' => 'Giuseppe Verdi',
		'actualizado' => '1853-03-06',
		'aceptado' => true,
		'idcategoria' => '11',
		'user_iden' => '2',
		]);  

		DB::table('libros') -> insert([
		'nombre' => 'Tosca',
		'descripcion' =>
		'Ópera de tres actos compuesta por la música de Giaccomo Puccini y el libreto de Luigi Illica y Giuseppe Giacosa. Fue estrenada en Roma el año de 1900 con gran aceptación del público en el teatro Costanzi. Su argumento está basado en La Tosca de Victorien Sardou, el cual contiene amor, intriga, pasión y muerte. Los hechos se centran en la ciudad de Roma el año 1800, cuando Napoleón Bonaparte vence a los austriacos en la batalla de Marengo.',
		'autor' => 'Giaccomo Puccini, Luigi Illica y Giuseppe Giacosa',
		'actualizado' => '1900-01-14',
		'aceptado' => true,
		'idcategoria' => '11',
		'user_iden' => '2',
		]);

		DB::table('libros') -> insert([
		'nombre' => 'MOCTEZUMA II',
		'descripcion' =>
		'El más conocido Moctezuma es el segundo emperador, quien tuvo que enfrentar el encontronazo, o Conquista, a cuenta de los españoles. Hoy ya se extinguió la campaña española que hace tres décadas atendieron los intelectuales de América Latina, en el sentido de que no se trató de una conquista con la cruz, el arcabuz y el evangelio, sino de un "encuentro entre dos culturas". Los intelectuales latinoamericanos recibieron dineros, preseas...',
		'autor' => 'Sergio Magaña',
		'actualizado' => '1985-03-06',
		'aceptado' => true,
		'idcategoria' => '12',
		'user_iden' => '2',
		]);  

		DB::table('libros') -> insert([
		'nombre' => 'Las brujas de Salem',
		'descripcion' =>
		'Las brujas de Salem o El crisol (en inglés: The Crucible) es una obra de teatro de Arthur Miller escrita en 1952 y estrenada en 1953 ganadora del Premio Tony. Está basada en los hechos que rodearon a los juicios de brujas de Salem, Massachusetts, en 1692. Miller escribió sobre el evento como una alegoría de la fiebre persecutoria y represión macarthista de los años 1950.',
		'autor' => 'Arthur Miller',
		'actualizado' => '1953-01-22',
		'aceptado' => true,
		'idcategoria' => '12',
		'user_iden' => '2',
		]);
    }
}
