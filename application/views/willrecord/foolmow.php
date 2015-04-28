<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <meta name="author" content="nicky" />
  <meta name="dcterms.rightsHolder" content="nicky" />
  <meta name="robots" content="all" />
  <meta name="googlebot" content="all" />

  <meta property="og:title" content="反對黑箱服貿 要求一切透明"/>
  <meta property="og:type" content="website"/>
  <meta property="og:image" content="<?php echo base_url();?>assets/img/backgrounds/ogmonkey.jpg"/>
  <meta property="og:url" content="<?php echo base_url();?>foolmow"/>
  <meta property="og:description" content="台灣人民為反對兩岸服務貿易協議的草率執行，現正佔領立法院抗議。鎮暴警察正在集結，準備強制驅離。這是對台灣未來和民主至關重要的時刻，我們需要世界的關注，請把這個消息分享給朋友。天佑台灣。"/>

  <title>反對黑箱服貿 要求一切透明</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo/monkey.ico" >
  <link rel="stylesheet" href="http://s.codepen.io/assets/reset/reset.css">
<style>
a{
  color:rgb(201, 201, 201);
  font-family: arial,微軟正黑體;
}
a:hover{
  color:rgb(255, 40, 40);
}
.link li{
  text-align: left;
  padding: 0 10% 20px 10%;
}

body{
  background:rgb(12, 12, 12);
  text-align:center;
}
div*{
  display:block;
}
.header{
  width: 100%;
  background-color: #fff;
  color: rgb(197, 25, 25);
  font-weight: bold;
  font-size: 18px;
  padding-top: 15px;
  height: 45px;
  font-family:arial;
}
.space{
  width:100%;
  height:500px;
  text-align:center;
  padding:100px 0px;
}
h1{
  font-family:微軟正黑體;
  font-weight:bold;
  font-size:40px;
  margin-bottom:20px;
  color: #fff;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
}
h3{
  font-family:微軟正黑體;
  font-weight:bold;
  font-size:30px;
  margin-bottom:20px;
  color: #fff;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
}
.monkey{
  display:inline-block;
  z-index: 100;
  text-align:center;
  width:50%;
  min-width: 140px;
  height:auto;
  -webkit-animation:flex 8s;
  -webkit-animation-iteration-count:infinite; 
}
@-webkit-keyframes flex
{
0%{width:140px;}
20%{width:300px;}
30%{width:140px;}
50%{width:300px;}
70%{width:140px;}
80%{width:300px;}
100%{width:140px;}
}
.head{
  width:140px;
  height:140px;
  background:rgb(84, 34, 8);
  border-radius:50%;
  position:relative;
  margin:0 auto;
}
.head:before,
.head:after{
  background:rgb(255, 244, 164);
  width:40px;
  height:40px;
  display:inline-block;
  border-radius:50%;
  border:rgb(84, 34, 8) 8px solid;
  line-height: 34px;
  font-size: 26px;
  position:absolute;
  z-index:-5;
  top:20px;
}
.head:before{
  content:")";
  left:-20px;
}
.head:after{
  content:"(";
  right:-20px;
}
.face{
  width:110px;
  height:70px;
  border-radius:0 0 50% 50%;
  background:rgb(255, 244, 164);
  position:absolute;
  bottom:10px;
  left:50%;
  margin-left:-55px;
}
.face:before,
.face:after{
  content:"";
  display:block;
  width:55px;
  height:55px;
  border-radius:50%;
  background:rgb(255, 244, 164);
  position:absolute;
  top:-25px;
}
.face:before{
  left:0;
}
.face:after{
  right:0;
}
.eye{
  margin:0 auto;
}
.eye:before{
  content:"ܫ";
  position:absolute;
  left:50%;
  margin-left:-11px;
  z-index:1;
  font-weight:bold;
  font-size:30px;
  top:10px;
}
.eye li{
  width:15px;
  height:15px;
  border-radius:50%;
  display:inline-block;
  background:black;
  position:relative;
  z-index:1;
  margin:5px 15px;
}
.eye .left:before{
  content:"╰";
  position:absolute;
  top:-10px;
  left:0;
  font-weight:bold;
}
.eye .right:before{
  content:"╯";
  position:absolute;
  top:-10px;
  right:0;
  font-weight:bold;
}
.body{
  width:80px;
  height:100px;
  background:rgb(84, 34, 8);
  margin:-20px auto 0 auto;
  position:relative;
  z-index:-1;
  top:-43px;
}
.body:before,
.body:after{
  content:"";
  display:block;
  width:30px;
  height:80px;
  background:red;
  position:absolute;
  background:rgb(84, 34, 8);
  bottom:-80px;
  border-radius:0 0 30% 30%;
}
.body:before{
  left:0;
}
.body:after{
  right:0;
}
.accordion{
  width:100%;
  height:50px;
  position:relative;
}
.accordion ul {
  display: block;
  border: 5px solid yellow;
  border-top: 0;
  border-bottom: 0;
  width: auto;
  height: 100%;
}
.accordion ul:before,
.accordion ul:after{
  content:"";
  width:50%;
  position:absolute;
  height:30px;
  background:rgb(84, 34, 8);
  z-index:-1;
  top:-10px;
}
.accordion ul:before{
  left:-10px;
  border-radius:20px 0 0 20px;
}
.accordion ul:after{
  right:-10px;
  border-radius:0 20px 20px 0;
}
.accordion li{
  float:left;
  width:5%;
  background:white;
  height:50px;
  line-height:50px;
  font-family:arial;
}
.accordion li:nth-child(odd){
  background:#dcdcdc;
}
p{
  text-align:left;
  margin:0 10% 10% 10%;
  text-align: justify;
  text-justify: inter-ideograph;
  font-family:微軟正黑體,arial;
  color: #fff;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
}
.footer{
  padding-top: 15px;
  width: 100%;
  height: 30px;
  background-color: rgb(122, 37, 37);
  color: #fff;

}
.footer a{
  color: pink;
  text-decoration: none;
}
.footer a:hover{
  color: pink;
  text-decoration: underline;
}
/*=========deer=======*/
.space2{
  position: absolute;
  top: 300px;
  left:-250px;
}
.space3{
  position: absolute;
  top: 300px;
  right:-250px;
}
.deer{
  -webkit-transform: scale(0.9);
  margin:0 auto;
  display:inline-block;
  text-align:center;
  width:60%;
  min-width: 140px;
  height:auto;
  -webkit-animation:flex2 2s;
  -webkit-animation-iteration-count:infinite; 
}
@-webkit-keyframes flex2
{
0%{width:140px;}
10%{width:50%;}
20%{width:140px;}
30%{width:50%;}
40%{width:140px;}
50%{width:50%;}
55%{width:140px;}
70%{width:80%;}
85%{width:140px;}
90%{width:80%;}
100%{width:140px;}
}
.antlers{
  width:130px;
  height: 35px;
  margin:0 auto;
}
.antlers li{
  width:10px;
  height:60px;
  background:rgb(84, 34, 8);
  position:relative;
}
.antlers .left{
  border-radius:0 50%;
  float:left;
  margin-left:30px;
}
.antlers li:before{
  content:"";
  width:20px;
  height:10px;
  background: inherit;
  display: block;
  position:absolute;
  top:20px;
}
.antlers .left:before{
  border-radius:0 0 0 50%;
  left:-19px;
}
.antlers .right:before{
  border-radius: 0 0 50% 0;
  right:-19px;
}
.antlers .right{
  border-radius:50% 0;
  float:right;
  margin-right:30px;
}
.head2{
  width:130px;
  height:140px;
  background:rgb(159, 89, 53);
  border-radius:50%;
  position:relative;
  margin:0 auto;
  background-image: radial-gradient(rgba(255,255,255,0.5) 10%, transparent 10%);
  background-size: 20px;
  
}
.head2:before,
.head2:after{
  background:rgb(255, 204, 204);
  width:40px;
  height:24px;
  display:inline-block;
  border:rgb(159, 89, 53) 8px solid;
  line-height: 34px;
  font-size: 26px;
  position:absolute;
  z-index:-5;
  top:10px;
}
.head2:before{
  content:")";
  left:-20px;
  border-radius:0 50% ;
  
}
.head2:after{
  content:"(";
  right:-20px;
  border-radius:50% 0;
  
}
.face2{
  width:40px;
  height:40px;
  border-radius:50%;
  background:rgb(183, 126, 70);
  position:absolute;
  bottom:12px;
  left:50%;
  margin-left:-20px;
}
.face2:before,
.face2:after{
  content:"";
  display:block;
  width:20px;
  height:20px;
  background:rgb(183, 126, 70);
  position:absolute;
  top:-25px;
}
.face2:before{
  left:-15px;
  border-radius:0 50%;
}
.face2:after{
  right:-15px;
  border-radius:50% 0;
}
.eye2{
  position:absolute;
  top:60px;
  left:50%;
  margin-left:-47px;
}
.eye2:before{
  content:"❤";
  position:absolute;
  left:50%;
  margin-left:-7px;
  z-index:1;
  font-weight:bold;
  font-size:14px;
  top:25px;
}
.eye2 li{
  width:15px;
  height:15px;
  border-radius:50%;
  display:inline-block;
  background:black;
  position:relative;
  z-index:1;
  margin:5px 15px;
}
.eye2 .left:before{
  content:"╰";
  position:absolute;
  top:-10px;
  left:0;
  font-weight:bold;
}
.eye2 .right:before{
  content:"╯";
  position:absolute;
  top:-10px;
  right:0;
  font-weight:bold;
}
.body2{
  width:80px;
  height:100px;
  background:rgb(159, 89, 53);
  margin:-20px auto 0 auto;
  position:relative;
  z-index:-1;
  top:-65px;
  background-image: radial-gradient(rgba(255,255,255,0.5) 10%, transparent 10%);
  background-size: 20px 15px;
  
}
.body2:before,
.body2:after{
  content:"";
  display:block;
  width:30px;
  height:80px;
  background:red;
  position:absolute;
  background:rgb(159, 89, 53);
  bottom:-78px;
  border-radius:0 0 30% 30%;
  background-image: radial-gradient(rgba(255,255,255,0.5) 10%, transparent 10%);
  background-size: 20px 15px;
}
.body2:before{
  left:0;
}
.body2:after{
  right:0;
}
.accordion2{
  width:41%;
  height:70px;
  position:relative;
  top:-27px;
  margin:0 auto;
}
.accordion2 ul {
  display: block;
  width: auto;
  height: 100%;
}
.accordion2 ul:before,
.accordion2 ul:after{
  content:"";
  width:50%;
  position:absolute;
  height:30px;
  background:rgb(159, 89, 53);
  z-index:-1;
  top:18px;
  background-image: radial-gradient(rgba(255,255,255,0.5) 10%, transparent 10%);
  background-size: 20px 15px;
}
.accordion2 ul:before{
  left:-15px;
  border-radius:20px 0 0 20px;
}
.accordion2 ul:after{
  right:-15px;
  border-radius:0 20px 20px 0;
}
.accordion2 li{
  width:5px;
  height:70px;
  position:relative;
}
.accordion2 .left{
 float:left;
 border-right:2px solid rgb(195, 178, 28);
 width: 0px;
 height: 0px;
 display:block;
 border-style: solid;
 border-width: 35px 25px 35px 0;
 border-color: transparent #c47bff transparent transparent;
 position: absolute;
}
.accordion2 .left:after{
  content:"";
  width:3px;
  height:70px;
  background:rgb(238, 190, 255);
  display:block;
  position: absolute;
  top: -34px;
  left: 25px;
  border-right:1px solid rgb(136, 65, 196);
}
.accordion2 .right{
 float:right;
  width: 0px;
  height: 0px;
  border-style: solid;
  border-width: 35px 0 35px 25px;
  border-color: transparent transparent transparent #c47bff;
}
.accordion2 .right:after{
  content:"";
  width:3px;
  height:70px;
  background:rgb(238, 190, 255);
  display:block;
  position: absolute;
  top: -34px;
  right: 25px;
  border-left:1px solid rgb(136, 65, 196);
}
p{
  text-align:left;
  margin:0 10% 10% 10%;
  text-align: justify;
  text-justify: inter-ideograph;
  font-family:微軟正黑體,arial;
  font-size:18px;
  color:white;
}
</style>
</head>

<body ontouchstart="">
<div class="header">Please help Taiwan! We have a disgusting government and bumbler Ma.<br>
We are Taiwanese, We are not part of China.</div>
<div class="space">
  <h1>反對黑箱服貿 要求一切透明</h1>
  <h1>政府不要把我們當猴子耍</h1>
  <h3>鹿茸不是鹿耳毛 台灣不是中國</h3>
  <div class="monkey">
    <div class="head">
      <div class="face">
        <ul class="eye">
          <li class="left"></li>
          <li class="right"></li>
        </ul>
      </div>
    </div>
    <div class="accordion">
      <ul>
        <li>B</li><li>U</li><li>M</li><li>B</li><li>L</li><li>E</li><li>R</li><li></li><li>M</li><li>A</li>
        
        <li></li><li>I</li><li>S</li><li></li><li>A</li><li></li><li>L</li><li>I</li><li>A</li><li>R</li>
      </ul>
    </div>
    <div class="body"></div>
  </div>
  <div class="space space2">
      <div class="deer">
        <ul class="antlers">
          <li class="left"></li>
          <li class="right"></li>
        </ul>
        <div class="head2">
          <div class="face2"></div>
          <ul class="eye2">
              <li class="left"></li>
              <li class="right"></li>
          </ul>
        </div>
        <div class="accordion2">
          <ul>
            <li class="left"></li>
            <li class="right"></li>
          </ul>
        </div>
        <div class="body2"></div>
      </div>
  </div>
  <div class="space space3">
      <div class="deer">
        <ul class="antlers">
          <li class="left"></li>
          <li class="right"></li>
        </ul>
        <div class="head2">
          <div class="face2"></div>
          <ul class="eye2">
              <li class="left"></li>
              <li class="right"></li>
          </ul>
        </div>
        <div class="accordion2">
          <ul>
            <li class="left"></li>
            <li class="right"></li>
          </ul>
        </div>
        <div class="body2"></div>
      </div>
  </div>
</div>
<p>中文：
  台灣人民為反對兩岸服務貿易協議的草率執行，現正佔領立法院抗議。鎮暴警察正在集結，準備強制驅離。這是對台灣未來和民主至關重要的時刻，我們需要世界的關注，請把這個消息分享給朋友。天佑台灣。</p>

<p>English：
Citizens of Taiwan are now occupying the Legislative Yuan, opposing the injustice passing of Cross-Strait Agreement on Trade in Services. The police is gathering outside the builiding and preparing to clear the protesters.
This moment is critical for the future and democracy of Taiwan, we need the world's attention. Please share the news to everyone you know, and translate it to other languages. (Please post the translation in the comment of this post). God bless Taiwan.</p>

<p>Français：
Les citoyens de Taïwan occupent maintenant le Yuan législatif, s'opposant à l'injustice passant de l'accord inter-détroit sur le commerce des services. La police recueille l'extérieur du bâtiment et se prépare à effacer les manifestants.
Ce moment est crucial pour l'avenir et de la démocratie de Taiwan, nous avons besoin de l'attention du monde. S'il vous plaît partager les nouvelles à tout le monde vous le savez, et de le traduire dans d'autres langues. (S'il vous plaît envoyer la traduction dans les commentaires de ce post, je vais l'ajouter à). Dieu bénisse Taiwan.)</p>

<p>日本語：
ただいま台湾の市民たちは立法院に立っており、「両岸（台湾と中国）サービス業貿易協議」の無理矢理可決への反対を示しています。警察は建物の外に集まっており、鎮圧の準備をしています。
この時には、台湾の民主と未来が掛かっております。世界中の皆様の注目が必要なんです。どうかこのニュースを出来る限り多くの人々に送って頂きたいんです。他の言語への翻訳もお願い申し上げます。（もしよければ、このスレに翻訳された文を書き込んで頂きたいんです。）天よ台湾を救い給え。</p>

<p>한국어：
대만 국민들이 어제 입법위원의 “양안(중국과 대만)복무무역협의 (兩岸服務貿易協議)” 부정당한 심사를 반대하기 때문에 지금 항의 표시로 입법원을 점령했습니다. 폭동 진압 경찰도 모이고 있는 걸 보니 시민들을 입법원에서 강제로 쫓아낼 것 같습니다. 대만의 민주와 미래의 결정적인 순간이라서 전세게의 주목이 급히 필요합니다. 이 메시지를 공유해 주시기 바랍니다. 감사합니다.</p>

<p>Deutsch：
Bürger Taiwans haben das Kongressgebäude besetzt um gegen die Ungerechtigkeit der Durchsetzung des Cross-Strait-Abkommens für den Handel im Dienstleistungssektor (Cross-Strait Agreement on Trade in Services) zu protestieren. Derweil bereiten sich Polizeikräfte außerhalb des Gebäudes darauf vor die Demonstranten aus dem Gebäude zu entfernen.
Dieser Moment ist entscheidend für die Zukunft und Demokratie Taiwans - und um die Zukunft und Demokratie Taiwans zu gewährleisten, brauchen wir Zuspruch und Hilfe aus aller Welt.
Bitte teilt diese Nachricht (und teilt auch eine Übersetzung in eurer Sprache als Kommentar.) Gott segne Taiwan.</p>

<p>廣東話：
台灣人民為左反對兩岸服務貿易協議粗暴既審查，宜家佔領緊立法院抗議，鎮暴警察亦都聚集左一齊，準備強制驅趕。呢個係對台灣既未來同民主都非常重要既時刻，我地需要世界既關注，請將呢個消息分享比所有朋友。天佑台灣。</p>

<p>Việt Ngữ：Trên toàn thế giới có quốc gia nào khi kháng nghị lại có tình gõ cửa phòng cảnh sát không? 
Hoặc là nhẹ nhàng đẩy cửa vào rồi lại âm thầm đóng cửa lại. Bạn cho tôi biết có quốc gia nào nhân dân có thái độ nhân văn đến thế không.
Để rồi 1 số giới truyền thông lại cho họ là bạo dân, gọi là vô tri thức, gọi là học sinh không có hành kiểm tốt, không biết lo cho bản thân mình thật tốt. 
Tôi không biết những người này nghĩ học sinh là gì nhỉ.
Chúng tôi không muốn bị giới truyền thông tự cho mình là đúng rồi thị phi bất phân. Phiền mọi người lan truyền đoạn phim ngắn ngày. 
Để cả nước Đài Loan và cả thế giới thấy được phẩm chất của nhân dân Đài Loan ,thấy được sự kháng nghị của quần chúng nhân dân là mang tính lý trí và có trước có sau, thấy được nhân dân đối với quyết định của chính quyền bất mãn kịch liệt. 
Tôi là người Đài Loan, tôi phản đối chính sách hợp tác Hắc sương<br/>
Nhân dân Đài Loan phản đối hành động Hợp tác mậu dịch song , hiện tại kháng nghị tại pháp đình. 
Cảnh sát cơ động đang tập trung lực lượng, chuẩn bị dàn sếp ổn định tình hình. 
Đây là thời khác quan trọng đối với tương lai của Đài Loan và nhân dân Đài Loan. 
Chúng tôi hy vọng sự quan tâm của thế giới, phiền các bạn hãy chia sẽ thông tin này.
Cầu trời phù hộ cho Đài Loan.</p>

<p>Swedish:
Taiwans medborgare ockuperar just nu lagstiftande parlamentet Yuan. De motsätter sig orättvisan i det sundsöverskridande avtal gällande handel i tjänster. Polisen har samlats utanför byggnaden och förbereder sig för att föra bort demonstranterna. Det här är en mycket kritisk stund för framtiden och demokratin i Taiwan, vi behöver hela världens uppmärksamhet. Hjälp oss genom att dela dessa nyheter med alla du känner, och översätt det till andra språk. (Posta sedan översättningen i kommentarsfältet nedan). Gud välsigne Taiwan.</p>

<p>Dutch: Burgers in Taiwan hebben het congresgebouw (Legislative Yuan) bezet om tegen de ongerechtigheid van de Cross-Strait-overeenkomst voor de handel binnen de service/diensten-sector (Cross-Strait Agreement on Trade in Services) te protesteren. Ondertussen bereidt zich de politie buiten het gebouw voor om de protesteerders uit het gebouw te verwijderen.
Dit moment is bepalend voor de toekomst en de democratie van Taiwan - daarom hebben we aandacht en hulp uit de hele wereld nodig!
Deel dit bericht alstublieft (en laat ook een vertaling naar jouw taal van dit bericht als commentaar achter). God zegen Taiwan!</p>

<h3>關於服貿的重要連結 IMPORTANT LINK!!</h3>
<ul class="link">
  <li><a href="http://edition.cnn.com/2014/03/19/world/asia/taiwan-student-protests/index.html" target="_blank">CNN-Hundreds of students occupy Taiwan's Legislature to protest China pact</a></li>
  <li><a href="http://inagist.com/all/446508013394747392/" target="_blank">PLEASE SIGN!! SAVE TAIWAN!! #反服貿 サービス貿易協定反対のホワイトハウス署名。ご署名＆ #拡散願います。 Oppose Trade Agreement Between Taiwan and China</a></li>
  <li><a href="http://www.asahi.com/articles/ASG3M4FHTG3MUHBI00V.html" target="_blank">朝日新聞-台湾学生ら、立法院占拠　中国との協定めぐり与党に抗議</a></li>
  <li><a href="http://ireport.cnn.com/docs/DOC-1108633" target="_blank">Taiwanese Students Protest against Cross-Strait Pact between China and Taiwan</a></li>
  <li><a href="http://plasticnews.wf/2014/03/congressoccupied/" target="_blank">【特別通告】 報告長官， #佔領立法院 已經傳到 冰島 波士尼亞 秘魯 等等等地方</a></li>
</ul>

<div class="footer">POWER BY <a href="http://blog.youmeb.com/archives/author/nickychen" target="_blank">衣夫人</a> <a href="http://codepen.io/nickycophia/pen/yusjK" target="_blank">codepen</a> and Taiwan good people</div>
</body>