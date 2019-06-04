

var chatMessage = // Initialisation du tableau contenant 2 messages
[{
		userPseudo: 'Tof le conquérant',
		message: 'Salut à toi preux chevalier !',
		date: 1971,
		id: 19876
	},
	{
		userPseudo: 'Dexter',
		message: 'I will kill you slowly with my knife',
		date: 1968,
		id: 19880
	}
];

var historique = []; // Tableau vide destiné à reccueillir les données à archiver

console.log(chatMessage);

function chat(chatMessage) {

if (historique.length < 12) {
	var nom = prompt('Tu veux bien saisir ton pseudo ?');
	var msg = prompt('Allez zou ! Maintenant saisis ton message !');
	var aujourdhui = new Date(); // Format date
	var timestamp = aujourdhui.getTime();

	console.log('le ' + aujourdhui + ' ' + nom + ' a écrit le message ' + '[ ' + msg + ' ]');

	var ID = Math.random(); // Numéro de référence du message généré aléatoirement
	chatMessage.unshift({
		userPseudo: nom,
		message: msg,
		date: aujourdhui,
		id: ID
	});
	historique.unshift({
		userPseudo: nom,
		message: msg,
		date: aujourdhui,
		id: ID
	});

	var splice = chatMessage.splice(5);
	console.log(chatMessage);
	console.log(historique);
	chat(chatMessage);
}

}

chat(chatMessage);

var div = document.createElement("div");
var body = document.body;

body.appendChild(div);
div.style.width = "520px";
div.style.height = "520px";
div.style.border = "4px solid #000";
div.style.padding = "10px";
div.style.margin = "25px";
div.style.borderColor = "#A1E325";
div.style.borderRadius = "15px";

var ul = document.createElement("ul");
div.appendChild(ul);


for (var index = 0; index < chatMessage.length; index++) {
ul.innerHTML += "<li> " + 'le ' + chatMessage[index].date + ', l\'internaute ' + chatMessage[index].userPseudo + ' ( id ' + chatMessage[index].id + ' ) a écrit : ' + chatMessage[index].message + " </li>";
}

var li = document.getElementsByTagName("li");

for (var i = 0; i < li.length; i++) {
li[i].style.background = "#A1E325";
}

