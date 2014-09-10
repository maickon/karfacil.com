-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27-log
-- Versão do PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `karfacil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `data_visita` varchar(255) NOT NULL,
  `dia_visita` varchar(255) NOT NULL,
  `hora` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `adicional` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `img_do_site`
--

CREATE TABLE IF NOT EXISTS `img_do_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baner_principal` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao_1` varchar(255) NOT NULL,
  `descricao_2` varchar(255) NOT NULL,
  `descricao_3` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `img_do_site`
--

INSERT INTO `img_do_site` (`id`, `baner_principal`, `slide`, `nome`, `descricao_1`, `descricao_2`, `descricao_3`, `data_cadastro`) VALUES
(1, 'karfacil.jpg', 'karfacil_logo_1.png', 'Krafacil', 'Apresentação 1!', 'Apresentação 1!', 'Apresentação 1!', '2014-09-03 15:35:02'),
(2, 'karfacil.jpg', 'karfacil_logo_2.png', 'Apresentação 2!', 'Apresentação 2!', 'Apresentação 2!', 'Apresentação 2!', '2014-09-03 15:35:53'),
(3, 'karfacil.jpg', 'karfacil_logo_3.png', 'Apresentação 3!', 'Apresentação 3!', 'Apresentação 3!', 'Apresentação 3!', '2014-09-03 15:36:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

CREATE TABLE IF NOT EXISTS `lojas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dono_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `CNPJ` varchar(255) NOT NULL,
  `loja_foto` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `telefone_res` varchar(255) NOT NULL,
  `telefone_cel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `google_map` varchar(255) NOT NULL,
  `google_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `lojas`
--

INSERT INTO `lojas` (`id`, `dono_id`, `nome`, `bairro`, `rua`, `numero`, `cep`, `logo`, `CNPJ`, `loja_foto`, `cidade`, `estado`, `telefone_res`, `telefone_cel`, `email`, `google_map`, `google_link`) VALUES
(1, 5, 'Amigo Carro', 'Centro', 'Rua das dores', '876', '33987-123', '791d553cde4fc2fa462c4c92b63921e2.jpg', '', '695bf7778b8d826394cb2f6952a32673.jpg', 'Rio de Janeiro', 'RJ', '22 998776523', '22 998776523', 'amigocarro@carros.com', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps/myplaces?ctz=180&amp;ie=UTF8&amp;ll=-14.239424,-53.186502&amp;spn=46.928672,86.572266&amp;t=m&amp;z=4"></iframe><br /><sm', 'https://maps.google.com.br/maps/myplaces?ll=-14.239424,-53.186502&spn=46.928672,86.572266&ctz=180&t=m&z=4'),
(2, 2, 'Info Carro', 'Centro', 'Rua das flores', '763', '282234-938', '112611bd961f625c554f995d0c8e46c3.jpg', '', 'ba3238a62da03445890eb31591c97592.jpg', 'Campos', 'RJ', '22 998776523', '22 998776523', 'infocarro@infocarro.com', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=Campos+dos+Goytacazes+-+RJ&amp;aq=0&amp;oq=campos&amp;sll=-14.239424,-', 'https://maps.google.com.br/maps?q=Campos+dos+Goytacazes+-+RJ&hl=pt-BR&sll=-14.239424,-53.186502&sspn=46.928672,86.572266&oq=campos&hnear=Campos+dos+Goytacazes+-+Rio+de+Janeiro&t=m&z=11'),
(3, 2, 'João Veículos', 'Centro', 'Rua das flores', '452', '33987-123', 'f760aa3ae4db82e5bce332e255e1ef91.jpg', '', '8332fc7fc82021da704ee8612a44c863.jpg', 'Rio de Janeiro', 'RJ', '22 998776523', '22 998776523', 'joao@veiculos.com', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps/myplaces?ctz=180&amp;t=m&amp;ie=UTF8&amp;z=4"></iframe><br /><small><a href="https://maps.google.com.br/maps/myplaces?ctz', 'https://maps.google.com.br/maps?q=rio+de+janeiro&hl=pt-BR&sll=-14.239424,-53.186502&sspn=46.928672,86.572266&hnear=Rio+de+Janeiro&t=m&z=10'),
(4, 5, 'Bentley', 'Centro', 'Rua das dores', '452', '28200-000', 'ee87601d4d36fd87e39123813b4a209a.jpg', '', '83076c4ff6d7beb6851b692a02998fac.jpg', 'Rio de Janeiro', 'RJ', '22 998776523', '22 998776523', 'Bentley@veiculos.com', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps/myplaces?ctz=180&t=m&ie=UTF8&z=4"></iframe><br /><small><a href="https://maps.google.com.br/maps/myplaces?ctz', 'https://maps.google.com.br/maps?q=rio+de+janeiro&hl=pt-BR&sll=-14.239424,-53.186502&sspn=46.928672,86.572266&hnear=Rio+de+Janeiro&t=m&z=10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario` varchar(255) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `data`, `usuario`, `assunto`, `texto`) VALUES
(1, 'Primeiras impressões: Toyota Corolla XEi 2015', '2014-09-03 17:21:41', 'Maickon rangel', '', '<p><span style="font-family:arial,helvetica,freesans,sans-serif">Ap&oacute;s pouco mais de 70 km ao volante do novo Corolla, &eacute; dif&iacute;cil entender como o antigo, praticamente o mesmo desde 2008 (salvo algumas f&uacute;teis reestiliza&ccedil;&otilde;es e atualiza&ccedil;&otilde;es de motores e c&acirc;mbio), n&atilde;o s&oacute; sobreviveu ao ataque forte da concorr&ecirc;ncia como foi l&iacute;der do segmento por quatro anos consecutivos (de 2009 a 2012). E &eacute; desafiador imaginar quais os pr&oacute;ximos passos da concorr&ecirc;ncia para impedir que o sed&atilde; da&nbsp;</span><a class="premium-tip" href="http://g1.globo.com/carros/marcas/toyota.html" style="font-family: arial, helvetica, freesans, sans-serif; font-size: 15px; margin: 0px; outline: 0px; padding: 0px; text-decoration: none; font-weight: bold; letter-spacing: -0.30239999294281006px; line-height: 21.923999786376953px; color: rgb(44, 73, 118) !important; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">Toyota</a><span style="font-family:arial,helvetica,freesans,sans-serif">&nbsp;conquiste mais um t&iacute;tulo.</span></p>\r\n\r\n<p><span style="line-height:1.6em">Isso porque a engenharia da Toyota usou uma f&oacute;rmula elementar na teoria, mas complexa e trabalhosa na pr&aacute;tica: melhorou o que j&aacute; era bom, e corrigiu o que era ruim. O Sed&atilde; tradicionalmente conservador ganhou certa ousadia, o que pode ser a grande sacada do</span><a class="premium-tip" href="http://g1.globo.com/carros/modelos/toyota-corolla.html" style="font-family: inherit; line-height: 1.6em; font-size: 15px; margin: 0px; outline: 0px; padding: 0px; text-decoration: none; font-weight: bold; color: rgb(44, 73, 118) !important; background: transparent;">Corolla</a><span style="line-height:1.6em">&nbsp;2015.</span></p>\r\n\r\n<div class="foto componente_materia midia-largura-300" style="font-family: arial, helvetica, freesans, sans-serif; font-size: 12px; margin: 0px 1.75em 2.5em 0px; outline: 0px; padding: 0px; overflow: hidden; zoom: 1; float: left; color: rgb(0, 0, 0); line-height: 12px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;"><img alt="Toyota Corolla 2015 (Foto: Divulgação)" src="http://s2.glbimg.com/ELg-BrDLHT15wlD45yz79YX2RhI=/300x225/s.glbimg.com/jo/g1/f/original/2014/03/11/tresquartos_depois.jpg" style="background:transparent; border:0px; display:block; font-family:inherit; height:225px; margin:0px; outline:0px; padding:0px; width:300px" title="Toyota Corolla 2015 (Foto: Divulgação)" /><span style="font-family:inherit">Toyota Corolla 2015 (Foto: Divulga&ccedil;&atilde;o)</span></div>\r\n\r\n<p>A come&ccedil;ar pelo visual. Far&oacute;is e grade frontal parecem formar uma pe&ccedil;a s&oacute;, atravessando a carroceria de uma lateral &agrave; outra, com o logotipo da marca pronunciado &agrave; frente.</p>\r\n\r\n<p>As lanternas deixam a timidez do conjunto anterior de lado e invadem a lateral.</p>\r\n\r\n<p>E, surpreendentemente, dessa vez ser&aacute; poss&iacute;vel comprar um Corolla vermelho &ndash; al&eacute;m dos tradicionais preto, prata e cinza, um interessante azul e um branco perolizado.<br />\r\n<br />\r\n<strong>Conte&uacute;do</strong><br />\r\nA gama se reduz a quatro vers&otilde;es: GLi Manual, GLi Multi-Drive, XEi Multi-Drive S e Altis Multi-Drive S. Por R$ 66.570, a configura&ccedil;&atilde;o de entrada repete o Corolla antigo com dire&ccedil;&atilde;o el&eacute;trica, ar-condicionado, computador de bordo (agora com indicador de condu&ccedil;&atilde;o econ&ocirc;mica), coluna da dire&ccedil;&atilde;o com regulagem de altura e profundidade, sistema de som com entrada USB e conex&atilde;o Bluetooth, far&oacute;is de neblina, retrovisores el&eacute;tricos e volante multifuncional. As novidades s&atilde;o a chave do tipo canivete (finalmente), sistema Isofix para fixa&ccedil;&atilde;o de cadeiras infantis e cinco airbags (frontais, laterais e uma para o joelho do motorista). Com c&acirc;mbio CVT, o Corolla GLi sobe para R$ 69.990.</p>\r\n\r\n<p><img alt="" src="http://s2.glbimg.com/TW8nguj8g2JwVR-q7LgH1KW75QI=/s.glbimg.com/jo/g1/f/original/2014/03/12/concorrentes-toyota.jpg" style="height:832px; width:620px" /></p>\r\n'),
(2, 'Land Rover lança Evoque Diesel no Brasil por R$ 244,1 mil', '2014-09-03 17:32:57', 'Maickon rangel', '', '<p>&nbsp;</p>\r\n\r\n<h2>Motor 2.2 de 190 cv est&aacute; dispon&iacute;vel nas vers&otilde;es mais completas do SUV.&nbsp;<br />\r\nN&iacute;vel de equipamentos e visual s&atilde;o os mesmos das vers&otilde;es a gasolina.</h2>\r\n\r\n<div>\r\n<p dir="rtl">&nbsp;</p>\r\n<img alt="Land Rover Range Rover Evoque 2014 (Foto: Divulgação / Marcos Camargo)" src="http://s2.glbimg.com/la1cqUPrd9xBVvcb4ftpPeAlNkc=/620x465/s.glbimg.com/jo/g1/f/original/2014/03/17/evo30.jpg" title="Land Rover Range Rover Evoque 2014 (Foto: Divulgação / Marcos Camargo)" />\r\n<p>Land Rover Range Rover Evoque (Foto: Divulga&ccedil;&atilde;o / Marcos Camargo)</p>\r\n\r\n<div>A&nbsp;<a href="http://g1.globo.com/carros/marcas/land-rover.html" style="line-height: 1.6em;">Land Rover</a>&nbsp;iniciou de forma discreta as vendas do Range Rover Evoque equipado com motor diesel. Os modelos j&aacute; aparecem no site oficial da marca, e podem ser encontrados em duas vers&otilde;es, Prestige, por R$ 244,1 mil e Prestige Tech Pack, por R$ 296,9 mil, sempre na configura&ccedil;&atilde;o cinco portas.</div>\r\n</div>\r\n\r\n<p>O propulsor adotado foi o mesmo quatro cilindros 2.2 turbodiesel de 190 cavalos e 42,8 kgfm de torque do Freelander 2. A diferen&ccedil;a &eacute; que o Evoque utiliza transmiss&atilde;o autom&aacute;tica de 9 marchas. Segundo dados de f&aacute;brica, o modelo acelera de 0 a 100 km/h em 8,5 segundos, atingindo m&aacute;xima de 195 km/h de m&aacute;xima.</p>\r\n\r\n<p>N&iacute;vel de equipamentos e visual s&atilde;o semelhantes &aacute;s vers&otilde;es equipadas com motor a gasolina, por&eacute;m, o pre&ccedil;o &eacute; R$ 25 mil no diesel, diferen&ccedil;a comum em modelos que possuem as duas vers&otilde;es.&nbsp; Todas as vers&otilde;es do&nbsp;<a href="http://g1.globo.com/carros/modelos/land-rover-range-rover-evoque.html">Range Rover Evoque</a>&nbsp;j&aacute; s&atilde;o linha 2015.</p>\r\n\r\n<p dir="rtl"><img alt="Motor 2.2 diesel do Range Rover Evoque (Foto: Divulgação)" src="http://s2.glbimg.com/bz8ab9bUMOT_vc123nYUUVNR45g=/620x465/s.glbimg.com/jo/g1/f/original/2014/09/03/rrevoque_2.2dieselmanual_2_lowres.jpg" title="Motor 2.2 diesel do Range Rover Evoque (Foto: Divulgação)" /></p>\r\n\r\n<div dir="rtl" style="margin-right: 960px;">Motor 2.2 diesel do Range Rover Evoque (Foto: Divulga&ccedil;&atilde;o)</div>\r\n\r\n<div dir="rtl">&nbsp;</div>\r\n\r\n<div dir="rtl">&nbsp;</div>\r\n\r\n<div dir="rtl">&nbsp;</div>\r\n'),
(3, 'Chery deve contratar 200 funcionários até o fim do ano em Jacareí, SP', '2014-09-03 17:37:40', 'Maickon rangel', '', '<div>\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div>\r\n<h1>Chery deve contratar 200 funcion&aacute;rios at&eacute; o fim do ano em Jacare&iacute;, SP</h1>\r\n\r\n<h2>Do total, 30 vagas j&aacute; est&atilde;o abertas para produ&ccedil;&atilde;o e administrativo.<br />\r\nPrimeira unidade da montadora no Brasil foi inaugurada na quinta-feira (28).</h2>\r\n</div>\r\n\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n\r\n<div id="materia-letra">\r\n<div>\r\n<div><img alt="Chery deve contratar 200 funcionários até o fim do ano em Jacareí, SP (Foto: Divulgação/ Chery)" src="http://s2.glbimg.com/BB18A1tNdwyziKPcLKv3BiX_rqU=/s.glbimg.com/jo/g1/f/original/2014/09/01/chery_jacarei.jpg" title="Chery deve contratar 200 funcionários até o fim do ano em Jacareí, SP (Foto: Divulgação/ Chery)" /></div>\r\n\r\n<div>F&aacute;brica da montadora chinesa foi inaugurada na quinta-feira (28). (Foto: Divulga&ccedil;&atilde;o/ Chery)</div>\r\n\r\n<p>Ap&oacute;s inaugura&ccedil;&atilde;o de sua f&aacute;brica em Jacare&iacute; na &uacute;ltima quinta-feira (28), a montadora Chery deve contratar outros 200 funcion&aacute;rios at&eacute; o final do ano. Do total de vagas, 30 j&aacute; est&atilde;o abertas para o setor de produ&ccedil;&atilde;o e administrativo. A unidade na regi&atilde;o &eacute; a primeira da empresa chinesa no Brasil e fora do pa&iacute;s de origem.<br />\r\n<br />\r\nAs etapas iniciais do processo de sele&ccedil;&atilde;o ser&atilde;o feitas por um site de emprego e redes sociais, al&eacute;m de parcerias com o Senai, o Posto de Atendimento ao Trabalhador (PAT) da cidade. Os curr&iacute;culos dos interessados tamb&eacute;m podem ser cadastrados no&nbsp;<a href="https://www.elancers.net/frames/cherybrasil/frame_geral.asp">site da empresa.</a><br />\r\n<br />\r\nPara os postos operacionais o ingl&ecirc;s n&atilde;o &eacute; exigido, mas &eacute; necess&aacute;rio ter o Ensino M&eacute;dio completo e, em alguns casos, conhecimentos espec&iacute;ficos ou experi&ecirc;ncia na &aacute;rea de atua&ccedil;&atilde;o. J&aacute; os analistas devem ter ensino superior e conhecimentos de ingl&ecirc;s.<br />\r\n<br />\r\nSegundo a empresa, at&eacute; o fim do ano mais vagas ser&atilde;o abertas gradativamente, de acordo com a demanda, para que a Chery alcance o objetivo de elevar o n&uacute;mero de trabalhadores para 500 at&eacute; dezembro.<br />\r\n<br />\r\nAtualmente 300 pessoas trabalham na nova f&aacute;brica e a estimativa da montadora &eacute; de chegar a 3 mil funcion&aacute;rios entre 2017 e 2018.&nbsp; Cerca de 30% dos atuais funcion&aacute;rios s&atilde;o profissionais que foram demitidos da f&aacute;brica da General Motors em S&atilde;o Jos&eacute; dos Campos</p>\r\n\r\n<p>Investimentos<br />\r\nA unidade do Vale do Para&iacute;ba come&ccedil;ou a ser erguida em 2011 e contou com investimento de cerca de U$ 400 milh&otilde;es. Durante a inaugura&ccedil;&atilde;o na semana passada, a montadora tamb&eacute;m anunciou um novo aporte de R$ 50 milh&otilde;es para um centro de pesquisa e desenvolvimento no pa&iacute;s. O local onde o centro ser&aacute; implantado ainda n&atilde;o foi definido pela empresa, mas h&aacute; a possibilidade do investimento ser feito no Vale do Para&iacute;ba por conta da proximidade com a f&aacute;brica de autom&oacute;veis.</p>\r\n\r\n<p>Com sua primeira f&aacute;brica no Brasil, a montadora espera alavancar as vendas no pa&iacute;s, alcan&ccedil;ando 3% de participa&ccedil;&atilde;o no mercado nacional at&eacute; 2018. Atualmente, no acumulado deste ano, a&nbsp;<a href="http://g1.globo.com/carros/marcas/chery.html">Chery</a>tem 0,27% de participa&ccedil;&atilde;o em vendas de autom&oacute;veis e comerciais leves, segundo dados da Anfavea, a associa&ccedil;&atilde;o das montadoras.</p>\r\n\r\n<p>Produ&ccedil;&atilde;o<br />\r\nA montadora informou que o Celer, primeiro modelo a ser fabricado em Jacare&iacute;, inicia sua produ&ccedil;&atilde;o nas vers&otilde;es hatch e sedan com mais de 50% de &iacute;ndice de nacionaliza&ccedil;&atilde;o. O ve&iacute;culo &eacute; atualmente trazido da China. Segundo a montadora, o &iacute;ndice de nacionaliza&ccedil;&atilde;o deve crescer com a implanta&ccedil;&atilde;o do centro de pesquisas.<br />\r\n<br />\r\nAt&eacute; dezembro ser&aacute; feita a fabrica&ccedil;&atilde;o em pr&eacute;-s&eacute;rie do modelo - cujos carros n&atilde;o ser&atilde;o colocados &agrave; venda. A produ&ccedil;&atilde;o dos ve&iacute;culos que ser&atilde;o comercializados s&oacute; come&ccedil;a em dezembro. No primeiro ano de funcionamento, a montadora estima que 50 mil carros ser&atilde;o fabricados.<br />\r\n<br />\r\nQQ e um SUV<br />\r\nAt&eacute; 2018, a montadora espera aumentar o n&uacute;mero de ve&iacute;culos fabricados para 150 mil por ano. No &uacute;ltimo trimestre de 2015, vai incluir na linha de produ&ccedil;&atilde;o outro hatch, o QQ, que tamb&eacute;m &eacute; importado atualmente e, na &eacute;poca de seu lan&ccedil;amento, em 2011, foi promovido como o carro mais barato do Brasil.</p>\r\n\r\n<p>Em Jacare&iacute; dever&aacute; ser fabricada a nova gera&ccedil;&atilde;o (<a href="http://g1.globo.com/carros/noticia/2013/04/primeiras-impressoes-chery-qq-nova-geracao.html">veja avalia&ccedil;&atilde;o)</a>, lan&ccedil;ada em 2013 no Sal&atilde;o de Xangai, e que, primeiramente, ser&aacute; importada para o mercado brasileiro.&nbsp; A partir de 2016 um SUV ser&aacute; produzido na unidade, mas a Chery n&atilde;o confirma se ser&aacute; o Tiggo, que j&aacute; &eacute; vendido no Brasil, tamb&eacute;m vindo da China, ou se haver&aacute; um projeto exclusivo para o mercado brasileiro.</p>\r\n\r\n<p>Motores<br />\r\nAl&eacute;m da unidade para fabricar carros, a montadora investiu US$ 130 milh&otilde;es na implanta&ccedil;&atilde;o de uma f&aacute;brica de motores tamb&eacute;m em&nbsp;<a href="http://g1.globo.com/sp/vale-do-paraiba-regiao/cidade/jacarei.html">Jacare&iacute;</a>. A unidade pode gerar mais 800 postos de empregos diretos na cidade e est&aacute; instalada em uma &aacute;rea a cerca de 5 km da f&aacute;brica de ve&iacute;culos.</p>\r\n</div>\r\n</div>\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiros`
--

CREATE TABLE IF NOT EXISTS `parceiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `propagandas`
--

CREATE TABLE IF NOT EXISTS `propagandas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dono_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `telefone1` varchar(255) NOT NULL,
  `telefone2` varchar(255) NOT NULL,
  `telefone3` varchar(255) NOT NULL,
  `telefone4` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `img_1` varchar(255) NOT NULL,
  `img_2` varchar(255) NOT NULL,
  `img_3` varchar(255) NOT NULL,
  `img_4` varchar(255) NOT NULL,
  `propaganda_completa` varchar(255) NOT NULL,
  `google_map` longtext NOT NULL,
  `google_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `propagandas`
--

INSERT INTO `propagandas` (`id`, `dono_id`, `nome`, `tipo`, `bairro`, `numero`, `cep`, `logo`, `cidade`, `estado`, `telefone1`, `telefone2`, `telefone3`, `telefone4`, `email`, `descricao`, `img_1`, `img_2`, `img_3`, `img_4`, `propaganda_completa`, `google_map`, `google_link`) VALUES
(6, 3, 'Auto Escola Futura', 'autoescola', 'Centro', '452', '28200-000', '52fa600d7b5860da5d990d7f669f2663.jpg', 'Rio de Janeiro', 'RJ', '', '', '', '', 'autoescola@futura.com', '<p>Descri&ccedil;&atilde;o da loja aqui.</p>\r\n', '91ec409e5ed15ea20a975d4a78bdcada.jpg', 'acee5bab08e7e1bc8024c39d1a50fedf.jpg', 'de7d46c9a8c23db93e3a4e3964f3796a.jpg', '6a3fc78dad83e7f2a1c6b5e24a0ed8f7.jpg', 's', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>', 'https://maps.google.com.br/maps?q=rio+de+janeiro&hl=pt-BR&sll=-14.239424,-53.186502&sspn=46.928672,86.572266&hnear=Rio+de+Janeiro&t=m&z=10'),
(7, 3, 'Alpha Autopeças', 'autopecas', 'Centro', '763', '28200-000', '3e3ba79948285de500fe68c7a32ef66f.jpg', 'Rio de Janeiro', 'RJ', '22 98762345', '22997094529', '', '', 'alpha@autopecas.com', '<p><span style="color:rgb(0, 0, 0); font-family:verdana; font-size:small">Recupera&ccedil;&atilde;o de P&aacute;ra-Choques e Retrovisores - Recupera&ccedil;&atilde;o e Pintura de Componentes Pl&aacute;sticos - Vendas de P&aacute;ra-Choques e Acess&oacute;rios em Geral - Multimarcas: Nacionais e Importados - Micro Pinturas - Funilaria e Pintura - Pinturas Especiais - Recupera&ccedil;&atilde;o de Far&oacute;is - Capotas Mar&iacute;timas - Far&oacute;is de Neblina - Partes Pl&aacute;sticas Internas - Calhas de Chuvas TG Poli - Palhetas - Grades Personalizadas - Lanternas - Aerof&oacute;lios - Apoileis - Santo Antonio, Rack - Pedaleiras - Capas Cromadas e Ma&ccedil;anetas - Para-Barros.</span></p>\r\n', 'fe9450c608bea440092ae19355d61a7d.jpg', 'cb77140dcae7b402ffdb3a441a279a61.jpg', 'b0fec7165e30c0572d24cacc5b20ecd6.jpg', '34d1329625c7e12c82c4f4901066131f.jpg', 's', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>', 'https://maps.google.com.br/maps?q=rio+de+janeiro&hl=pt-BR&sll=-14.239424,-53.186502&sspn=46.928672,86.572266&hnear=Rio+de+Janeiro&t=m&z=10'),
(8, 3, 'Schuvarts Auto Peças', 'autopecas', 'Centro', '876', '33987-123', '4c30c07f3b34850360444cdf5ad7f869.jpg', 'Rio de Janeiro', 'RJ', '22 98762345', '22997094529', '', '', 'schuvarts@autopecas.com', '<p><span style="color:rgb(0, 0, 0); font-family:verdana; font-size:small">Auto Pe&ccedil;as e Acess&oacute;rios Volkswagen - Fiat - Ford - Chevrolet GM - Importados - Mais de 15.000 &iacute;tens - Far&oacute;is - Lanternas - Bagageiros - Limpadores de Parabrisa - Lonas e Pastilhas de Freio - Guarni&ccedil;&otilde;es - &Oacute;leos lubrificantes e graxas - Aditivos para Radiadores - Bombas d&#39; &aacute;gua - Correias - Mangueiras - Frisos - Amortecedores - Molas - Rodas de Ferro - Discos e Tambores - Calotas - Baterias - Pe&ccedil;as para acabamentos - Fechaduras - Ma&ccedil;anetas - M&aacute;quinas de Vidros - Retrovisores - Retentores - Rolamentos - Capas para Volantes.</span></p>\r\n', '40ef097ff6d07253f541f023afc5f553.jpg', '1db79850dfb23400a19e2aab78231a21.jpg', '473e92282f4a1d6bf0ba0654c223c25d.jpg', 'a8531ca6c40e2114400f67441b81b97e.jpg', 's', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>', 'https://maps.google.com.br/maps?q=rio+de+janeiro&hl=pt-BR&sll=-14.239424,-53.186502&sspn=46.928672,86.572266&hnear=Rio+de+Janeiro&t=m&z=10'),
(9, 3, 'Skema Pneus', 'borracharia', 'Centro', '876', '33987-123', 'dc7897c7cf2b501e43dcd5926797d0bf.jpg', 'Rio de Janeiro', 'RJ', '22 98762345', '22997094529', '', '', 'skema@pneus.com', '<p><strong>Borracharia</strong>&nbsp;&eacute; um local de com&eacute;rcio e presta&ccedil;&atilde;o de servi&ccedil;os relacionados a manuten&ccedil;&atilde;o de&nbsp;<a href="http://pt.wikipedia.org/wiki/Roda" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Roda">rodas</a>&nbsp;e&nbsp;<a href="http://pt.wikipedia.org/wiki/Pneu" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Pneu">pneus</a>&nbsp;de&nbsp;<a class="mw-redirect" href="http://pt.wikipedia.org/wiki/Carros" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Carros">carros</a>,&nbsp;<a class="mw-redirect" href="http://pt.wikipedia.org/wiki/Motos" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Motos">motos</a>&nbsp;entre outros.</p>\r\n\r\n<p>No&nbsp;<a href="http://pt.wikipedia.org/wiki/Brasil" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Brasil">Brasil</a>, as borracharias mais comuns, geralmente prestam os servi&ccedil;os de conserto de furos, calibragem, conserto de&nbsp;<a class="mw-redirect" href="http://pt.wikipedia.org/wiki/V%C3%A1lvulas" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Válvulas">v&aacute;lvulas</a>, servi&ccedil;os de trocas de pneus e rodas entre outros relacionados. Tamb&eacute;m costumam operar em hor&aacute;rios alternativos e em locais distantes dos grandes centros, onde torna-se mais necess&aacute;ria sua utiliza&ccedil;&atilde;o.</p>\r\n', '7369c6c3b94320c8e2b302e84cbae965.jpg', 'aa6a5b8006e2a5ecfcc1c8b752405540.jpg', '2ea6c6be34cbc346a3edb5390d31cb93.jpg', '4aad291b5a3a597551f247b112144945.jpg', 'n', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=rio+de+janeiro&amp;aq=&amp;sll=-14.239424,-53.186502&amp;sspn=46.928672,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Rio+de+Janeiro&amp;t=m&amp;z=10&amp;ll=-22.908308,-43.197026" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>', 'https://maps.google.com.br/maps?q=rio+de+janeiro&hl=pt-BR&sll=-14.239424,-53.186502&sspn=46.928672,86.572266&hnear=Rio+de+Janeiro&t=m&z=10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` varchar(1) NOT NULL DEFAULT 's',
  `tipo` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validade` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `telefone`, `login`, `senha`, `ativo`, `tipo`, `data_cadastro`, `validade`) VALUES
(1, 'Maickon rangel', 'maickonmaickon@hotmail.com', '', 'Maickon rangel', 'abb4e82a6e3838c0631b402e4f9e6df2', 's', 'administrador', '2014-04-16 13:20:01', ''),
(2, 'Carlos', 'carlos@gmail.com', '22 998651209', 'carlos2014', 'c70a1d7e8959e67f0f258d1c13b2708a', 's', 'dono de loja', '2014-09-03 15:52:15', '30 dias'),
(3, 'Alberto', 'alberto@gmail.com', '22 998653872', 'alberto2014', '795705d71043120a97d7f7c882ffb20c', 's', 'dono de propaganda', '2014-09-03 15:53:50', '30 dias'),
(4, 'Leticia', 'leticia@gmil.com', '22 998698870', 'leticia2014', 'dd42f170a60748804f532ab00397e9af', 's', 'dono de carro', '2014-09-03 15:54:37', '30 dias'),
(5, 'Amanda', 'amanda@hotmail.com', '22 997394429', 'amanda2014', '6209804952225ab3d14348307b5a4a27', 's', 'dono de loja', '2014-09-03 15:55:20', '30 dias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE IF NOT EXISTS `veiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dono_id` int(11) NOT NULL,
  `pertencente` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cambio` varchar(255) NOT NULL,
  `cilindrada` varchar(255) NOT NULL,
  `direcao` varchar(255) NOT NULL,
  `transmissao` varchar(255) NOT NULL,
  `combustivel` varchar(255) NOT NULL,
  `portas` varchar(255) NOT NULL,
  `kilometragem` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `ano` varchar(255) NOT NULL,
  `versao` varchar(255) NOT NULL,
  `img_1` varchar(255) NOT NULL,
  `img_2` varchar(255) NOT NULL,
  `img_3` varchar(255) NOT NULL,
  `img_4` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `dono_id`, `pertencente`, `nome`, `preco`, `cor`, `categoria`, `estado`, `cambio`, `cilindrada`, `direcao`, `transmissao`, `combustivel`, `portas`, `kilometragem`, `marca`, `modelo`, `ano`, `versao`, `img_1`, `img_2`, `img_3`, `img_4`, `descricao`) VALUES
(1, 4, 'exclusivo', 'Toyota Corolla', '62.100,00', 'Prata', 'carros', 'Novo', 'Manual', '', '', '', 'Flex', '4', '0Km', 'Toyota', 'Corolla', '2015', '', '567c09489e57dd0c23ad265c43cdac58.jpg', 'd038d92fbb7b62e26ba638217bdb3658.jpg', '789dab0c6354533be903100b750dbb8c.jpg', '9e71fbaf3b067a8ccd5e9c395d77a0ae.jpg', '<p><strong>Linha 2015</strong><br />\r\nDe s&eacute;rie, o Corolla traz desde a vers&atilde;o b&aacute;sica GLi manual dire&ccedil;&atilde;o el&eacute;trica, ar-condicionado, computador de bordo, coluna de dire&ccedil;&atilde;o com regulagem de altura e pro'),
(2, 4, 'exclusivo', 'Fiat Grand Siena Essence ', '44.990,00', 'Prata', 'carros', 'Novo', 'Manual', '', '', '', 'Flex', '4', '0Km', 'Fiat ', '1.6 E.torQ (Flex) ', '2015', '', 'd23cf87f9e9ff87a9b6e6062337eb6ae.jpg', '681cdcdc18d224e7dee8cc2c259c7ea9.jpg', 'b130f09f19d5618219299c16edd15ef6.jpg', 'b3ced98bf4666f194768009fdc59e994.jpg', '<p><span style="color:rgb(68, 68, 68); font-family:arial,verdana,arial narrow,sans-serif; font-size:14px">VIDRO EL&Eacute;TRICO TRASEIRO, PINTURA METALICA. NECESS&Aacute;RIO VERIFICAR DISPONIBILIDADE DE ESTOQUE. FOTOS ILUSTRATIVAS.N&deg; ESTOQUE 147399 Os'),
(3, 4, 'exclusivo', 'Hilux Cabine Dupla', '152.350,00', 'Prata', 'carros', 'Novo', 'Manual', '', '', '', 'Flex', '4', '0Km', ' Toyota', 'Cabine Dupla', '2015', '', 'e2436d287d1c15062e098631460809e5.jpg', 'c90355dfc583b88cb9985ff8952c0eef.jpg', 'bb330ec9f70b78f33063a36fedd14260.jpg', '8b8b8199d15039fc6b6bff7481765161.jpg', '<p><strong>Pontos positivos:</strong>&nbsp;boa em mec&acirc;nica.</p>\r\n\r\n<p><strong>Pontos negativos:</strong>&nbsp;estabilidade com m&eacute;dia seguran&ccedil;a. f&aacute;cil de tombar em movimento brusco lateral.</p>\r\n'),
(4, 1, 'loja', ' Fox', '35.900,00', 'Azul', 'carros', 'Novo', '', '', '', '', 'Flex', '4', '0Km', 'Volkswagen', 'Fox', '2015', '', '06b70a7fdf796b8522b7c4564b3239d6.jpg', '0c5df0d37e53cfa24420ca6222c32734.jpg', '1589331bce1a6155116792dc3c99edd2.jpg', '1ba5284fc8fffffea93a397bba7e2e90.jpg', '<p><strong>Linha 2015</strong></p>\r\n\r\n<p>A linha 2015 do Volkswagen Fox mudou o visual, ganhou uma op&ccedil;&atilde;o de motor mais potente, novo c&acirc;mbio manual de seis marchas e mais equipamentos. No exterior, ele recebeu nova grade, far&oacute;is '),
(5, 2, 'loja', ' Hyundai', '52.890,00', 'Preto', 'carros', 'Novo', '', '', '', '', 'Flex', '4', '0Km', ' Hyundai', 'HB20', '2015', '', 'f67eb255896e82b21b0936c2a96e9ca6.jpg', 'c38a3dc239520544c1b1f49247f6d62a.jpg', '7e0575c3c900f2a0e15d6cdb2c93f865.jpg', 'c8966f80489f9b142cff548bfeacec41.jpg', '<p><strong>Linha 2015</strong></p>\r\n\r\n<p>Depois de apresentar a linha 2015 para o HB20 apenas na s&eacute;rie especial Copa do Mundo, agora todas as configura&ccedil;&otilde;es do hatch da Hyundai mudaram de ano/modelo. Entre as novidades est&atilde;o a o'),
(6, 1, 'loja', 'Ecosport ', '81.390,00', 'Laranja', 'carros', 'Novo', '', '', '', '', 'Flex', '4', '0Km', 'Ford', 'Ecosport', '2015', '', '78d898e8e73576703e64e18d61c4192f.jpg', 'e00ce799746650bf7cccc57c624c4067.jpg', '5517abdc5a39a26b69fb2e25cae81ab2.jpg', '0ef6d2525aafa5caa0368d37089ca971.jpg', '<p><strong>Sob o cap&ocirc;</strong><br />\r\nO SUV compacto da Ford &eacute; oferecido com motoriza&ccedil;&atilde;o 1.6 Sigma e 2.0 Duratec, ambas bicombust&iacute;veis, que j&aacute; servem ao New Fiesta e ao Focus. O propulsor menor desenvolve 115 cv co'),
(7, 1, 'loja', 'Honda', '13.690,00', 'Preto', 'motos', 'Novo', '', '300', '', '', 'Gasolina', '', '0Km', 'Honda', 'CB 300R', '2014', '', '876e9f722c784e736694d230bcf564b9.jpg', '64b65f14b501204e3e6e8c8c88de2397.jpg', '876c6bee9f93f6d677c109ecef6e9ad8.jpg', '622ba6387a1b57aa11defd8e6b00e9dd.jpg', '<p><strong>Pontos positivos:</strong>&nbsp;- motor forte e el&aacute;stico - acabamento adequado ao pre&ccedil;o - visual esportivo e moderno</p>\r\n\r\n<p><strong>Pontos negativos:</strong>&nbsp;- suspens&atilde;o muito dura - elevado peso da motocicleta&nbs'),
(8, 2, 'loja', 'Honda Biz', '6.400,00', 'Branco', 'motos', 'Novo', '', '125', '', '', 'Gasolina', '', '0Km', 'Honda', 'Biz', '2014', '', '2352b49f125ca0911d5576cd7b596055.jpg', 'cd0c637e2bc778ade09a6919d352cf34.jpg', 'a1259f0576093d5b29d0f54c521f22f4.jpg', '2635f8e6b6c0b98011a98ba5f594a2b9.jpg', '<p><strong>Pontos positivos:</strong>&nbsp;super econ&ocirc;mica, facil de pilotar, bonita &oacute;tima para mulheres. adoro a minha...</p>\r\n\r\n<p><strong>Pontos negativos:</strong>&nbsp;carenagem faz barulho. so vai at&eacute; a 4a marcha.</p>\r\n'),
(9, 2, 'loja', ' CB 600 (Hornet)', '31.990,00', 'Caramelo', 'motos', 'Novo', '', '600', '', '', 'Gasolina', '', '', 'Honda', 'CB 600 (Hornet) ', '2013', '', '2485aaf924734bd6141cce2971be62c8.jpg', '328434c76eb765844bdee78b041da0b8.jpg', 'c05ee4445d362fab785ff3267fd4232d.jpg', '3a5cd4ba464183e306417ccb10e7e771.jpg', '<p style="text-align:center"><span style="font-family:inherit; font-size:inherit">Pontos positivos:</span>&nbsp;- motor forte e el&aacute;stico - acabamento adequado ao pre&ccedil;o - visual esportivo e moderno</p>\r\n\r\n<p style="text-align:center"><span st'),
(10, 4, 'loja', ' F 4000', '98.725,00', 'Azul', 'caminhão', 'Novo', '', '', '', '', 'Flex', '2', '0Km', ' Ford', 'F 4000', '2015', '', 'cd17335a71a2c7d57ffb78ef426073c9.jpg', 'f0165c457961f66492370429f9fc2537.jpg', 'f5f5c57c57d927270181f5513663e422.jpg', '60522962ac3974b4c0eaddfb1b51e519.jpg', '<p>Um &oacute;timo ve&iacute;culo.</p>\r\n'),
(11, 4, 'loja', ' Volvo FH 440 ', '378.521,00', 'Amarelo', 'caminhão', 'Novo', '', '', '', '', 'Flex', '2', '0Km', ' Volvo', 'FH 440 ', '2012', '', '94db7f35e17176025b3cb262c2b64042.jpg', 'e5238a389e6e728482f015fb319c2501.jpg', '3960bc1ccc856655916eb2d729d2ef7c.jpg', 'a04dbf262521ae129e8176a35764365f.jpg', '<p><strong>Pontos positivos:</strong>&nbsp;ecelente ou otimo</p>\r\n\r\n<p><strong>Pontos negativos:</strong>&nbsp;nao tem</p>\r\n'),
(12, 4, 'loja', ' Volkswagen 10.160', '152.635,00', 'Prata', 'carros', 'Novo', '', '', '', '', 'Flex', '2', '0Km', ' Volkswagen » 10.160', '10.160', '2014', '', '286ecf53b5dc5c0593b8efa34a0f88de.jpg', '751a32a396a0a6ceb60e70d318cfcd20.jpg', 'da9890f0db9129ee1cb14f0bcf8f1040.jpg', 'f50b1bc07db5e0b3173a6513831f488b.jpg', '<p><strong>Pontos positivos:</strong>&nbsp;conforto para dirigi</p>\r\n\r\n<p><strong>Pontos negativos:</strong>&nbsp;corforto pata dormi os farois dele e pouca luz</p>\r\n'),
(13, 3, 'loja', ' JET SKI VX 1100', '35.000,00', 'Preto', 'náuticos', 'Novo', '', '', '', '', 'Gasolina', '', '', 'Yamaha', 'VX 1100', '2012', '', '5ee321027aeb4b1f4249dc7be631119d.jpg', '580f9eae5d4495cbf97a6a1f144d78cf.jpg', 'ea5deaadce05cd672feeec153db3d5a6.jpg', '1a54b1c935c1a22ae49b0b33f4f1e2b8.jpg', '<p>&oacute;timo estado!</p>\r\n'),
(14, 3, 'loja', 'Jet Ski Sea Doo', '44.990,00', 'Amarelo', 'náuticos', 'Novo', '', '', '', '', 'Gasolina', '', '', 'Sea Doo', 'Se  155', '2012', '', 'd40272361b028296950d0b241175bcad.jpg', '8f819902ddd86d7c193e42075c9997bc.jpg', '7febce2d9f573096dd8bdf017a6a2361.jpg', 'a0a6f94b22691b0f1f38939482ffb98a.jpg', '<p>Um jet Ski</p>\r\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
