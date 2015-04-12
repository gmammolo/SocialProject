/**
 * Convalida il testo per verificare che non ci siano caratteri non accettabili
 * @see Per convalidare con altre Espressioni regolari usare <code>re.test(string)</code> 
 * @param {String} string
 * @returns {boolean}
 */
function validatePassword(string)
{
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    return !re.test(string);
}

function validateRegularString(string)
{
    var re = /\w*/i ;
    return re.test(string) ;
}

function getHome()
{
    return "http://php.server/SocialProject/index.php";
}