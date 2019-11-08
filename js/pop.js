function uploadBtn() 
{
    document.getElementById("uploadpop").classList.toggle("show");
}
function pictureBtn() 
{
    document.getElementById("picturepop").classList.toggle("show");
}

window.onclick = function(event) 
{
    if (!event.target.matches('.uploadbtn')) 
    {
        var pop = document.getElementsByClassName("uploadpop-cont");
        var i;
        for (i = 0; i < pop.length; i++)
        {
            var openPop = pop[i];
            if (openPop.classList.contains('show'))
            {
                openPop.classList.remove('show');
            }
        }
    }
    else if (!event.target.matches('.picturebtn')) 
    {
        var pop = document.getElementsByClassName("picturepop-cont");
        var i;
        for (i = 0; i < pop.length; i++)
        {
            var openPop = pop[i];
            if (openPop.classList.contains('show'))
            {
                openPop.classList.remove('show');
            }
        }
    }
}