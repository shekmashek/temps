@extends('./layouts/admin')
<style>
    h6 {
        text-align: justify;
    }
    ul {
        overflow: auto;
    }
    .nav-link {
        color: black !important;
    }
    h2 {
        color: #801D68;
    }
    .row_conditions {
        padding-bottom: 5rem;
        overflow: hidden;
    }
    /* .row_conditions .col-4{
        position: sticky;
        top: 5rem;
    } */
    .test{
        position: sticky;
        top: 5rem;
    }
    /* .row_conditions header{
        position: sticky;
        top: 5rem;
    } */
</style>
@section('content')
<div class="container-fluid row_conditions">
    <div class="row">
        <div class="col-3">
            <ul class="nav flex-column navperso pt-4">
            <br>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#politique">Politique de confidentialité</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#modification">Modification de la politiques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#recueil">Recueil d'information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#collecte">Collecte d’information en provenance de site tiers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#utilisation">Utilisation des informations du site web</a>
                </li>
                {{--<li class="nav-item">
                    <a class="nav-link " href="#balise">Balises Web</a>
                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="#données">Données d’adresse IP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#information">Comment nous utilisons l’information collectée</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#capacite">Votre capacité à choisir l’opt out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#divulgation">Divulgation de vos informations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#site_web">Sites web tiers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mineurs">Mineurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#reproduction">Reproduction de données personnelles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#images">Images, logos, marques et droits d’auteur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#credits">Crédits du site</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#comptes">Suspension ou suppression de compte </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link " href="#responsabilite">Responsabilités et garanties du Client
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#comportement">Comportements prohibés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#obligation">Obligations et responsabilité du A WORLD FOR US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#propriete">Propriété Intellectuelle
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#donnees">Données à caractère personnel</a>
                </li> --}}

            </ul>
        </div>
    <div class="col-8">
        <span class="float-end">Dernière mise à jour : le 27 Avril 2022 <hr class="my-2"></span><br>
        <h1 class="mt-5">Politique de confidentialité de la plateforme <span id="politique">Temps.mg</span></h1>
        <div >
            <h2 >Politique de confidentialité</h2>
            <h6 >Merci de lire cette politique avec attention pour comprendre comment la société UPSKILL SARL  traite les informations issues de ce site. </h6>
            <h6 id="modification">En visitant ou en utilisant ce site web, vous acceptez les termes de cette politique.</h6>
            <h6> Si vous avez des questions, commentaires ou interrogations concernant cette politique, merci de contacter contact-mg@upskill-sarl.com </h6>
        </div>
        <div>
            <h2 >Modifications de la politique</h2>
           <h6 > Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. </h6>
            <h6 >Toute modification de cette politique de confidentialité, y compris les informations recueillies
             et l’utilisation et la divulgation des informations, sera  affichée sur cette page.<span id="recueil"></span> </h6>
             <div ></div>
             <h6 >Suite  à toute modification, nous mettrons à jour la date de « dernière mise à jour » en haut de cette page.</h6>

              <h6 >Assurez-vous de vérifier périodiquement la version la plus récente de notre politique de confidentialité.</h6>

        </div>
        <div>
            <h2 >Recueil d’information</h2>
           <h6 > Lorsque vous visitez notre site web, nous recueillerons des données personnelles à partir de votre poste de travail.
                Ces informations nous permettent de déterminer comment vous avez trouvé notre site et nous permettent d’améliorer les fonctionnalités de celui-ci.
             </h6>
            <h6 >Les informations que vous fournissez peuvent être classées en deux catégories, décrites plus en détail ci-après:</h6>
            <ul class="list-group ps-5">
                <li>- les informations fournies par l’utilisateur </li>
                <li>- les informations sur les informations personnelles que vous choisissez de partager</li>
            </ul>
            <h6 >Selon que vous remplissez un formulaire sur notre site, communiquez avec nous par e-mail, par téléphone ou autrement,
                les informations que vous nous fournissez et que nous allons collecter peuvent inclure votre nom, votre adresse email,
                votre numéro de téléphone, votre adresse email, votre entreprise, votre position, l’adresse de votre entreprise ainsi que
                le détail de votre requête. Nous pouvons également collecter des informations supplémentaires, telles que des enquêtes ou des
                 événements marketing.</h6>
            <h6 id="collecte">Si vous nous fournissez des informations personnelles, il vous appartient de nous informer immédiatement de tout changement
                apporté aux informations que vous avez fournies et mettre à jour vos données personnelles en envoyant un courrier électronique à contact-mg@upskill-sarl.com
            </h6 >
        </div>
        <div>
            <h2 >Collecte d’information en provenance de site tiers</h2>

        <h6 > À l’occasion, nous pouvons recevoir des informations personnelles vous concernant provenant de sources tierces,
            y compris de partenaires avec lesquels nous collaborons de temps en temps dans le cadre d’activités de marketing communes
             <span id="utilisation" >et de sources accessibles au public.</span></h6>
        <div ></div>
        <h6  >Nous pouvons également recevoir des données analytiques et publicitaires sur vous concernant votre visite ou sur façon dont vous avez
             trouvé notre site web.
    </h6>

    </div>

    <div>
        <h2>Utilisation des informations du site web</h2>
        <h6 style="font-weight: bold" >Navigation et cookies</h6>
        <h6>Nous ne recueillons pas d’informations personnelles telles que votre nom, votre adresse professionnelle, votre numéro de téléphone ou
            votre adresse électronique lorsque vous naviguez simplement sur notre site.</h6>
        <h6>UPSKILL SARL utilise à la fois des cookies de session sur son site, qui sont stockés dans la mémoire temporaire et non conservés après la fermeture
            du navigateur, et des cookies persistants, qui stockent des informations sur votre disque dur. Ainsi, lorsque vous revenez sur le même site Web à une
            date ultérieure, les informations relatives aux cookies sont toujours présentes.</h6>
        <h6>Celles-ci ne sont lisibles que par les employés de UPSKILL SARL et les cookies ne peuvent accéder, lire ou modifier aucune autre donnée de votre ordinateur.
            Ils sont utilisés pour collecter des informations sur vos choix et préférences et personnaliser notre site en conséquence, y compris l’intégration
            avec les médias sociaux et des publicités adaptées à vos besoins.</h6>
        <h6> Par exemple, pour effectuer une analyse statistique du nombre d’utilisateurs et de leurs habitudes d’utilisation afin d’améliorer la vitesse de chargement
             des pages.UPSKILL SARL ne vend aucune donnée collectée par ces cookies ou issues de vos données personnelles.
        </h6>
        <h6>Nous utilisons également des cookies à des fins d’analyse, notamment via Google Analytics, afin de collecter des informations sur votre utilisation
             de notre site et de nous permettre d’améliorer l’expérience de navigation.</h6>
        <h6 > Par exemple, les cookies d’analyse nous permettent  d’analyser la nature du trafic global, ainsi que les pages les plus visitées sur notre site,
            et de déterminer si notre publicité est efficace ou non.
        </h6>
        <h6>Vous devriez pouvoir contrôler les spécifications des cookies via les paramètres de votre navigateur.</h6>
        {{-- <h6 >Les options du navigateur et les instructions d’utilisation correspondantes se trouvent généralement dans le manuel du navigateur ou dans le
            <span id="balise" > fichier d’aide.</span></h6> --}}
        <h6 >Si vous refusez, bloquez ou désactivez les cookies, cela pourrait limiter la disponibilité des services proposés via le site Web.
            De plus, certaines parties du site Web peuvent ne pas fonctionner correctement dans certaines circonstances.
        </h6>
    </div>
      <div>
        {{--<h2>Balises Web</h2>
        <h6>Une balise Web est une image graphique souvent invisible qui est placée sur un site Web ou dans un courrier électronique et utilisée pour surveiller
             le comportement de l’utilisateur visitant le site Web ou l’émetteur – courrier électronique de suivi et marquage de page pour l’analyse Web.
             Nous pouvons utiliser des balises Web (ou des pixels de suivi) seuls ou
            conjointement avec des cookies, pour rassembler des informations sur votre utilisation de notre site et sur les interactions avec les courriers
            électroniques de UPSKILL SARL. Dans la perspective d’améliorer l’expérience de notre site Web et la communication client,
            les balises Web peuvent être utilisées par nos analystes marketing dans des messages électroniques ou des lettres d’information pour déterminer
            si le message a été ouvert ou pour nous permettre de compter les utilisateurs ayant visité certaines pages, générer des statistiques sur l’utilisation
            de notre site.
        </h6>--}}
        <h6 id="données">Ils ne sont pas utilisés pour accéder à des informations personnellement identifiables.
        </h6>
        <h6 >Contrairement aux cookies, vous ne pouvez pas refuser les balises Web. Toutefois, si votre navigateur refuse les cookies ou vous invite à répondre,
            les balises Web ne pourront pas suivre votre activité.</h6>
    </div>
    <div>
        <h2>Données d’adresse IP</h2>
        <h6>Nos serveurs collectent automatiquement des données sur votre adresse de protocole Internet lorsque vous nous rendez visite. </h6>
    <h6> Lorsque vous naviguez sur des pages de notre site Web, nos serveurs peuvent enregistrer votre adresse IP et parfois votre nom de domaine.
         Nos serveurs peuvent également enregistrer la page de renvoi qui vous a lié à nous (par exemple, un autre site Web ou un moteur de recherche);
         les pages que vous visitez sur ce site Web; le site Web que vous visitez après ce site Web; d’autres informations sur le type de navigateur Web,
         l’ordinateur, la plate-forme, les logiciels associés et les paramètres que vous utilisez; les termes de recherche que vous avez entrés sur ce site Web
          ou sur un site Web de référence.
    </h6>
    <h6>Nous utilisons ces informations pour l’administration interne du système, pour diagnostiquer les problèmes de nos serveurs et pour administrer notre site Web.</h6>
    <h6>Ces informations peuvent également être utilisées pour rassembler des informations démographiques générales, telles que le pays d’origine et
         le fournisseur de services Internet.</h6>
    <h6>Les informations personnelles (y compris les adresses IP) ne sont pas utilisées pour faciliter le contact avec des utilisateurs qui n’ont pas fourni
        leurs coordonnées. </h6>
    <h6>Votre adresse IP peut être utilisée pour identifier le clickstream* qui vous a conduit sur notre site. Toutefois, les informations personnelles
        ne sont<span id="capacite"> partagées avec aucune société de marketing tierce.</span>
    </h6>
    <h6   style="font-style: italic">(*En étude du comportement du consommateur internaute, le clickstream représente l’analyse des chemins empruntés
    par lui sur un site Internet.)</h6>
</div>
    <div>
        <h2>Votre capacité à choisir l’opt out</h2>
        <h6>Nous vous fournissons les informations que vous avez demandées en nous envoyant un courrier électronique ou en saisissant votre demande sur notre site Web.</h6>
        <h6>Nous pouvons également vous envoyer des informations et des offres de la part de la Société et de nos fournisseurs de services tiers. </h6>
        <h6>Vous avez le droit de nous demander de ne pas traiter vos données personnelles à des fins de marketing.</h6>
        {{--<h6 > Vous pouvez toujours choisir de ne pas recevoir nos courriels marketing en suivant le processus de désinscription au bas de chaque courriel
            que vous recevez de notre part.</h6>--}}
            <h6> pouvez également modifier vos préférences en ce qui concerne les types de courriels que vous recevez de notre
            part en nous envoyant un courrier électronique à l’adresse contact-mg@upskill-sarl.com.</h6>
    </div>
<div>
    <h2 id="information">Comment nous utilisons l’information collectée</h2>
    <h6>Nous utilisons les informations que nous recueillons à votre sujet conformément à la présente politique de confidentialité. Nous ne vendons jamais d’informations
         personnelles à des tiers.</h6>
    <h6>Nous pouvons utiliser vos informations personnelles afin de :</h6>
    <ul>
        <li>-vous fournir des informations (par courrier, email ou téléphone) sur les solutions et services que vous pouvez demander ou que nous pensons pouvoir
             vous intéresser, tels que la promotion, le marketing et la communication événementielle, si vous avez donné votre accord pour être contacté à ces fins;</li>
        <li>-vous informer des modifications apportées à notre site, à notre politique de confidentialité, à nos produits ou services;</li>
        <li>-vous permettre de participer à des fonctionnalités interactives de notre site Web lorsque vous le souhaitez;</li>
        <li>améliorer notre site Web (à des fins d’administration et de marketing), notamment en ce qui concerne le dépannage, les tests et la recherche, ainsi que
            dans le cadre de nos efforts pour protéger notre site;
        </li>
    </ul>
    <h6 >Nos serveurs Web collectent et enregistrent automatiquement les données d’utilisation du Web lorsque vous visitez notre site Web.
         Ces informations, y compris, comme précisé plus haut votre adresse IP, le site de référence, les pages consultées et la durée de la visite,
         <span  id="divulgation"> nous informent de la manière dont les visiteurs utilisent et naviguent sur notre site Web.</span>
        </h6>
        <h6>  Ces informations sont enregistrées dans nos bases de données.</h6>

    </div>
<div>
    <h2>Divulgation de vos informations</h2>
    <h6>Notre politique générale est de ne divulguer aucune donnée personnelle à un tiers, sauf avec votre consentement préalable ou sur une base légale.</h6>
    <h6>
        UPSKILL SARL se conformera à tout moment aux réglementations, lois, ordonnances de la cour ou demandes officielles applicables.
    </h6>
    <h6>Dans ce cadre, nous pouvons divulguer des informations personnelles pour nous conformer à une procédure légale valide telle qu’un mandat de perquisition,
        une assignation à comparaître, une autorité de surveillance ou une ordonnance du tribunal, si les actions d’un utilisateur enfreignent nos politiques ou
         pour protéger nos droits et la propriété de UPSKILL SARL.</h6>
    <h6 >UPSKILL SARL se réserve donc le droit de divulguer des données à caractère personnel aux autorités de régulation et de surveillance,
        ainsi qu’à des fournisseurs de services d’analyse conformément à la présente déclaration de confidentialité.</h6>
    <ul>
        <li >-Nous ne partagerons ces informations avec aucune autre personne, société ou organisation, à l’exception des tiers qui vous fourniront des produits
             ou des services, conformément à votre accord avec UPSKILL SARL et dans la mesure où la loi l’exige.</li>
        <li >-Les informations concernant l’utilisation de nos sites ne seront divulguées à des tiers que sous forme globale / ou anonyme, de telle sorte que vos
            informations ne seront pas personnellement identifiables. Ces informations globales / anonymes sont collectées sur la base de données d’utilisation du
            <span id="site_web"> Web ou d’informations statistiques que nous avons assemblées à propos de nos utilisateurs.</span>
        </li>
    </ul>
</div>
<div>
    <h2 >Sites web tiers</h2>
    <h6>Notre site Web contient des liens vers des sites Web de tiers qui sont fournis pour votre commodité.</h6>
    <h6 >UPSKILL SARL n’approuve ni n’est responsable des pratiques de confidentialité,du contenu ou des services desdits  sites Web. <span id="mineurs"></span></h6>
    <h6 > Nous vous recommandons de consulter les politiques de confidentialité et les conditions d’utilisation qui régissent ces sites Web lorsque vous les visitez.
    </h6>
</div>
<div>
    <h2 >Mineurs</h2>
    <h6>Ce site est destiné aux adultes. UPSKILL SARL ne collecte pas sciemment d’informations auprès de mineurs de moins de 18 ans. Les jeunes de moins de 18 ans
         ne doivent pas utiliser ce site Web ni nous<span id="reproduction" > soumettre d’informations. </span></h6>
    <h6 >S’il nous arrive de collecter des données personnelles d’individus de moins de 18 ans, nous supprimerons immédiatement ces informations personnelles.
    </h6>
</div>
<div>
    <h2 >Reproduction de données personnelles</h2>
    <h6>Des photos et des données personnelles de collaborateurs de UPSKILL SARL ont été incluses sur ce site Web avec l’autorisation expresse de la personne concernée.</h6>
    <h6>Les photos et les données personnelles de clients ont été incluses sur ce site Web avec l’autorisation expresse de la <span id="images">personne concernée.</span></h6>
    <h6 >En aucun cas, des photos et / ou des données personnelles de collaborateurs ou de clients ne peuvent être reproduites sans l’autorisation écrite de UPSKILL SARL.
         Pour obtenir la permission, contactez-nous au contact-mg-@upskill-sarl.com.
    </h6>

</div>
<div>
    <h2>Images, logos, marques et droits d’auteur</h2>
    <h6>Les images, logos, marques de commerce et droits d’auteur appartiennent à leurs propriétaires respectifs et ont été utilisés avec l’autorisation expresse de leurs propriétaires.
         Ils ne doivent pas être copiés à partir de notre site. </h6>
    <h6>Tout le contenu de ce site (image, vidéo, son, texte…) est protégé par les lois en vigueur à Madagascar dans le domaine de la propriété intellectuelle et notamment
        le droit d’auteur, les droits voisins, le droit des marques.</h6>
    <h6 >Tous les droits de reprographie sont réservés, y compris en ce qui concerne les documents téléchargeables et les représentations
        <span id="credits">photographiques ou graphiques.</span></h6>
    <h6 >En l’absence d’autorisation expresse de UPSKILL SARL, il est strictement interdit d’exploiter ces contenus et notamment de les reproduire, les représenter,
        les modifier ou les adapter en tout ou en partie.</h6>
</div>
<div>
    <h2>Crédits du site</h2>
    <h6 style="font-weight: bold">Objet et base légale du traitement</h6>
    <h6>Nous recueillons et utilisons vos informations personnelles lorsque cela est nécessaire pour la gestion des produits et services que nous vous proposons,
         à vous ou à votre organisation, pour la relation commerciale associée, ainsi que pour nous conformer à nos obligations légales.</h6>
    <h6>Nous pouvons également collecter et utiliser vos informations personnelles pour suivre un intérêt légitime afin de créer et de gérer un réseau de professionnels
         des ressources humaines/formation, de fournir des informations et des ressources relatives aux formations et de promouvoir nos produits entre professionnels.
        Nous analyserons vos interactions avec nous pour comprendre votre profil et votre niveau d’intérêt pour nos produits et services (par exemple, pour décider de
        vous inclure ou non dans une campagne donnée).</h6>
    <h6>Les informations peuvent être collectées directement auprès de vous, de votre organisation ou d’autres tiers autorisés.</h6>
    <h6>Lorsqu’un consentement est requis, une demande de consentement vous est fournie.</h6>
    <h6 style="font-weight:bold">Vos droits</h6>
    <h6>Vous pouvez exercer vos droits en tant que personne concernée (accès, rectification, effacement, restriction et objection, ainsi que la portabilité)
        en nous contactant via contact-mg@upskill-sarl.com.</h6>
    <h6>Lorsque le traitement est basé sur le consentement, vous avez le droit de retirer votre consentement à tout moment.<h6>
    <h6 style="font-weight: bold">Revu de vos informations / Nous contacter</h6>
    <h6>Vous pouvez consulter et mettre à jour les informations personnelles que nous avons collectées à votre sujet en nous contactant à l’adresse contact-mg@upskill-sarl.com.</h6>
    <h6>Pour protéger votre vie privée et votre sécurité, nous pouvons prendre des mesures raisonnables pour vérifier votre identité avant de divulguer ces informations aux tiers
        mentionnés dans cette politique ou d’y apporter des corrections.</h6>
    <h6>Les droits spécifiés ci-dessus peuvent être refusés ou limités si les intérêts, les droits et les libertés de tierce partie ont préséance ou si le traitement est
         nécessaire pour établir, exercer ou défendre des droits légaux de UPSKILL SARL</h6>
    <h6 style="font-weight: bold">Prise de décision automatisée</h6>
    <h6>Nous n’utiliserons pas les informations que nous collectons pour prendre des décisions automatisées qui pourraient avoir un effet juridique ou significatif sur vous.</h6>
     <h6>Les informations personnellement identifiables que nous recueillons à votre sujet sont stockées sur des serveurs à accès restreints gérés par nos fournisseurs
          de services de logiciels. Bien que nous maintenons des garanties raisonnables pour empêcher tout accès non autorisé, pour maintenir la sécurité des données et
          pour utiliser correctement les informations que nous recueillons, nous ne garantissons aucune transmission de données sur Internet.</h6>
</div>
<div>
    <h2>Suspension ou suppression de compte </h2>
    <h6>Vous pouvez nous demander de suspendre votre compte à tout moment en nous contactant via contact-mg@upskill-sarl.com .
        La suspension de votre compte n’assigne pas la suppression de votre compte mais l’arrêt de vos activités sur notre site :
         vous ne vous afficherez plus dans les résultats de recherche, vous ne pourrez plus interagir avec vos collaborateurs ni les voir,
         ils ne pourront plus non plus voir votre profil,...</h6>
    <h6>Néanmoins, vous pouvez toujours accéder à votre compte pour voir vos données ainsi que ceux que vous avez partagé avec vos collaborateurs,
        et ces derniers auront aussi cet accès. Ainsi pour cette raison la suppression de ce dernier ne pourrait pas être possible.</h6>
    <h6>Nous conservons vos données personnelles le cas échéant pour vous fournir des services et aussi longtemps que cela s’avère nécessaire pour les finalités définies
        à l’origine ou pour toute période plus longue qui pourrait être requise à des fins juridiques, d’audit et de conformité.</h6>
    <h6 >Cela inclut les données que vous ou d’autres personnes nous avez fournies et les données générées ou déduites de votre utilisation de nos services.
         Toutes les informations conservées resteront soumises aux termes de cette politique.
        Vous avez le droit de réactiver votre compte à tout moment en nous contactant via contact-mg@upskill-sarl.com </h6>
</div>
<span  id="comptes"></span>
</div>
</div>
</div>
@endsection
