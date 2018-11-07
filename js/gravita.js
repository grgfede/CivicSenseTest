const src_path ="/images/icons/";

function get_gravita(gravita){
	var path_immagine;
	switch (gravita){
		case 1:
		path_immagine = src_path+"green.png";
		break;
		case 2:
		path_immagine = src_path+"yellow.png";
		break;
		case 3:
		path_immagine = src_path+"red.png";
		break;
	} 
	return path_immagine;
}