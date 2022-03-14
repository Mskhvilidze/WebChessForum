var registrationPassword = document.getElementById("password");
registrationPassword.onkeyup = function() {
	checkPassword();
}
	
function checkPassword() {
	var password = registrationPassword.value;
	if (!password) {
		var infos = document.getElementById("password-info").querySelectorAll("p");
		for (let i = 0; i < infos.length; i++) {
			hidePasswordInfo(true, infos[i]);
		}
		return;
	}
	var lowerCaseLetters = /[a-z]/g;
	hidePasswordInfo(lowerCaseLetters.test(password), document.getElementById("password-lowercase"));
	var upperCaseLetters = /[A-Z]/g;
	hidePasswordInfo(upperCaseLetters.test(password), document.getElementById("password-uppercase"));
	var numericValue = /[0-9]/g;
	hidePasswordInfo(numericValue.test(password), document.getElementById("password-numericvalue"));
	var length = 8;
	hidePasswordInfo(password.length >= length, document.getElementById("password-length"));
    var specialSymbols = /[a-zA-Z0-9]/;
    hidePasswordInfo(checkSpecialSymbol(), document.getElementById("password-specialSymbol"));
	
	checkPasswordRepeat();
}

var registrationPasswordRepeat = document.getElementById("passwordRepeat");
registrationPasswordRepeat.onkeyup = function() {
	checkPasswordRepeat();
}

function checkPasswordRepeat() {
	var password = registrationPassword.value;
	var passwordRepeat = registrationPasswordRepeat.value;
	if (!passwordRepeat) {
		var infos = document.getElementById("password-info-repeat").querySelectorAll("p");
		for (let i = 0; i < infos.length; i++) {
			hidePasswordInfo(true, infos[i]);
		}
		return;
	}
	hidePasswordInfo(password === passwordRepeat, document.getElementById("password-repeat"));
}

function hidePasswordInfo(shouldHide, element) {
	element.style.display = (shouldHide) ? "none" : "block";
}

function checkSpecialSymbol() {
    var password = registrationPassword.value;
    var only_this = "ABCDEFGHIJKLMNOPQRSTUVWXYZÄÖÜabcdefghijklmnopqrstuvwxyzäöüß0123456789";
    for (var i = 0; i < password.length; i++) {
        if (only_this.indexOf(password.charAt(i)) < 0) {
            return false;
        }
    }
    return true;
} 