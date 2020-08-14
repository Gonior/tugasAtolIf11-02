const getLastMessage = async () => {
	let res = await fetch(
		"https://api.telegram.org/bot1378605142:AAGARF4iEKzxoig34Ouf59rlwLVP12CkEe8/getUpdates"
	);
	let json;
	if (res.status === 200) {
		json = await res.json;
	}
	if (json[json.length - 1].message.text === "KONFIRMASI") {
		alert("pembayaran sukses");
	} else {
		alert("AHHH");
	}
};
