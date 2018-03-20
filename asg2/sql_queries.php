<?php
/*
define ('GETCOUNTRYWITHDETAILS','select CountryName, Capital, Area, Population, CurrencyName, CountryDescription from Countries where ISO =?;');

define('GETIMAGEDETAILS','select Path,Title,Description,ImageDetails.UserID,FirstName,LastName,ISO,CountryName,AsciiName 
            from ImageDetails 
            inner join Users on ImageDetails.UserID=Users.UserID 
            inner join Countries on ImageDetails.CountryCodeISO=Countries.ISO 
            inner join Cities on ImageDetails.CityCode=Cities.CityCode 
            where ImageID=$Uid;');
            
define('GETSINGLEIMAGEDETAILS','select ImageID, Title, Path, Description from ImageDetails where ImageID = ?;');


//

define ('GETALLCOUNTRIES','select c.CountryName,c.ISO from Countries c inner join ImageDetails i on i.CountryCodeISO = c.ISO group by c.CountryName');
define ('GETSINGLECOUNTRY','select CountryName,Capital,Area,Population,CurrencyName,CountryDescription from Countries where ISO ="'.$_GET["code"].'"');
define ('GETIMAGESBYCOUNTRY','select i.Path,i.title,i.ImageID, c.CountryName from ImageDetails i inner join Countries c on c.ISO = i.CountryCodeISO where CountryCodeISO = "'.$_GET["code"].'"');
define ('GETUSERSLIST','select Firstname, Lastname, UserID from Users order by Lastname');
define ('GETSINGLEUSER','select Firstname, Lastname, Address, City, Postal, Country, Phone, Email from Users where UserID ="'.$_GET["id"].'"');
define ('GETCOUNTRYBYUSER','select i.Path, u.UserID, i.ImageID,u.FirstName, u.LastName from ImageDetails i inner join Users u on i.UserID = u.UserID and u.UserID ="'.$_GET["id"].'"');
define ('GETCONTINENTNAME','select ContinentName from Continents');
//DROP DOWN MENUS
define ('CONTINENTDROPDOWN','SELECT c.ContinentName, c.ContinentCode from Continents c inner join ImageDetails i on i.ContinentCode = c.ContinentCode group by c.ContinentName');
define('COUNTRYDROPDOWN','SELECT coun.CountryName, coun.ISO FROM Countries coun JOIN ImageDetails image ON coun.ISO = image.CountryCodeISO GROUP BY coun.ISO ORDER BY coun.CountryName');
define('CITYDROPDOWN','select cit.AsciiName, cit.CityCode from Cities cit inner join ImageDetails i on cit.CityCode = i.CityCode group by cit.AsciiName');

define('CITYLIST','select CityCode,AsciiName from Cities');*/

?>