<?php

// $path = "https://api.telegram.org/bot1378605142:AAGARF4iEKzxoig34Ouf59rlwLVP12CkEe8";
// $update = json_decode(file_get_contents("php://input"), TRUE);
// $chatID = $update["message"]["chat"]["id"];
// $message = $update["message"]["text"];
// if (strpos($message, "konfirmasi") === 0) {
//     file_get_contents($apiURL."/sendmessage?chat_id=".$chatID.
//     "&text=Haloo");
// }


// function kirimTelegram($pesan) {
//     $pesan = json_encode($pesan);
//     $API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".CHAT_ID."&text=$pesan";
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//     curl_setopt($ch, CURLOPT_URL, $API);
//     $result = curl_exec($ch);
//     curl_close($ch);
//     return $result;
// }

// kirimTelegram('Nani sayangg');
?>
<script scr="/index.js">
const getLastMessage = async () => {
	let res = await fetch(
		"https://api.telegram.org/bot1378605142:AAGARF4iEKzxoig34Ouf59rlwLVP12CkEe8/getUpdates"
	);
	let json;
	if (res.status === 200) {
        json = await res.json();
        
    }
    let id = json.result[json.result.length - 1].message.chat.id;
	if (json.result[json.result.length - 1].message.text === "KONFIRMASI") {
        alert("pembayaran sukses");
        
        
        sendNotif("Selamat Pembayaran berhasil.. ", id)
        // window.location.href = "index.php"
        
	} else {
        alert("Pembayaran Gagal");
        sendNotif("Maaf pembayaran anda lakukan gagal.. ", id)
	}
};

const sendNotif = async (message, chat_id) => {
    let req = await fetch(`https://api.telegram.org/bot1378605142:AAGARF4iEKzxoig34Ouf59rlwLVP12CkEe8/sendMessage?chat_id=${chat_id}&text=${message}`)
}
window.addEventListener("load", function () {
    
        setTimeout(() => {
            getLastMessage();        
            
        }, 100000);    
    
}
)

</script>