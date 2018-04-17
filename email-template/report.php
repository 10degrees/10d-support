<?php  ?>
<!DOCTYPE html>
<html>
<head>
<title>WordCare Activity Report <?php echo date('F, Y'); ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        .wrapper {
          width: 100% !important;
        	max-width: 100% !important;
        }

        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        .logo img {
          margin: 0 auto !important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        .mobile-hide {
          display: none !important;
        }

        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }

        /* FULL-WIDTH TABLES */
        .responsive-table {
          width: 100% !important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        .padding {
          padding: 10px 5% 15px 5% !important;
        }

        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        .no-padding {
          padding: 0 !important;
        }

        .section-padding {
          padding: 50px 15px 50px 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }

        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }

    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important;">

<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    Your 10° WordCare Activity Report is ready to view...
</div>

<!-- HEADER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#bb272c" align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                        <a href="https://10degrees.uk" target="_blank">
                          <svg width="72px" height="72px" viewBox="0 0 72 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                      <defs>
                          <polygon id="path-1" points="0 71.9831907 0 0.0409027237 71.9596576 0.0409027237 71.9596576 71.9831907"></polygon>
                      </defs>
                      <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="Light-Header" transform="translate(0.000000, -1.000000)">
                              <g id="Nav">
                                  <g id="10-logo-white" transform="translate(0.000000, 1.000000)">
                                      <path d="M61.6179922,12.0242802 C63.2260856,12.0242802 64.5290895,13.3284047 64.5290895,14.9353774 C64.5290895,16.5426304 63.2260856,17.8467549 61.6179922,17.8467549 C60.0098988,17.8467549 58.7068949,16.5426304 58.7068949,14.9353774 C58.7068949,13.3284047 60.0098988,12.0242802 61.6179922,12.0242802 Z M55.9501634,14.9891673 C55.9501634,18.1067393 58.4763268,20.6331829 61.5936187,20.6331829 C64.7092296,20.6331829 67.2359533,18.1067393 67.2359533,14.9891673 C67.2359533,11.872716 64.7092296,9.34627237 61.5936187,9.34627237 C58.4763268,9.34627237 55.9501634,11.872716 55.9501634,14.9891673 L55.9501634,14.9891673 Z" id="Fill-1" fill="#FFFFFE"></path>
                                      <g id="Group-5">
                                          <mask id="mask-2" fill="white">
                                              <use xlink:href="#path-1"></use>
                                          </mask>
                                          <g id="Clip-3"></g>
                                          <path d="M41.3663813,27.6423969 C39.0237198,27.6423969 37.2559377,28.4509261 36.0638755,30.0677043 C35.069323,31.4174942 34.5717665,33.1779922 34.5717665,35.3475175 C34.5717665,37.8493074 34.970428,39.6983346 35.7657899,40.8937588 C36.8696031,42.555642 38.9144591,43.3857432 41.896716,43.3857432 C44.4161556,43.3857432 46.1836576,42.5763735 47.2006226,40.9615564 C47.9962646,39.6983346 48.392965,37.8268949 48.392965,35.3475175 C48.392965,33.0670506 47.8522646,31.2519222 46.7691829,29.9012918 C45.5527471,28.3954553 43.7524669,27.6423969 41.3663813,27.6423969" id="Fill-2" fill="#FFFFFE" mask="url(#mask-2)"></path>
                                          <path d="M67.9677198,19.5358132 C67.1986926,20.6110506 66.1665992,21.4854163 64.9641712,22.0611362 C67.1317354,26.3788949 68.3543346,31.2494008 68.3543346,36.4011829 C68.3543346,54.084607 53.9677821,68.4711595 36.2837977,68.4711595 C18.5992529,68.4711595 4.21185992,54.084607 4.21185992,36.4011829 C4.21185992,18.7174786 18.5992529,4.33064591 36.2837977,4.33064591 C43.3420389,4.33064591 49.8735875,6.62428016 55.1760934,10.503035 C55.9790195,9.35803891 57.079751,8.43772763 58.3653852,7.85388327 C52.2210117,2.96404669 44.44193,0.0409027237 35.9789883,0.0409027237 C16.1083891,0.0409027237 0,16.1501323 0,36.021572 C0,55.8916109 16.1083891,72 35.9789883,72 C55.8512685,72 71.9596576,55.8916109 71.9596576,36.021572 C71.9596576,30.079751 70.5182568,24.474677 67.9677198,19.5358132" id="Fill-4" fill="#FFFFFE" mask="url(#mask-2)"></path>
                                      </g>
                                      <path d="M54.293323,35.4808716 C54.293323,39.9944591 53.0441089,43.2246537 50.5484825,45.1722957 C48.5142724,46.7422879 45.5527471,47.528965 41.6647471,47.528965 C37.3567938,47.528965 34.1750661,46.6209805 32.1198444,44.8066926 C29.8654319,42.8156265 28.7392062,39.6182101 28.7392062,35.2158444 C28.7392062,31.6099611 29.7441245,28.7991595 31.7542412,26.7854008 C33.9428171,24.595144 37.2125136,23.5000156 41.565572,23.5000156 C46.3604358,23.5000156 49.7413541,24.5503191 51.7077665,26.6523268 C53.4304436,28.5114397 54.293323,31.4539144 54.293323,35.4808716 Z M20.1389883,47.0975253 L26.3702101,47.0975253 L26.3702101,23.9297743 L20.1389883,23.9297743 L20.1389883,47.0975253 Z M36.2837977,7.61771206 C20.4118599,7.61771206 7.49892607,20.5298054 7.49892607,36.4011829 C7.49892607,52.2717198 20.4118599,65.1838132 36.2837977,65.1838132 C52.1548949,65.1838132 65.0672685,52.2717198 65.0672685,36.4011829 C65.0672685,31.4936965 63.8317821,26.8702879 61.6569339,22.8228794 C61.6359222,22.8231595 61.6149105,22.8245603 61.5938988,22.8245603 C57.2733385,22.8245603 53.7585058,19.3097276 53.7585058,14.9891673 C53.7585058,14.5280311 53.8008093,14.0767004 53.877572,13.6374163 C49.0093074,9.86596109 42.9044358,7.61771206 36.2837977,7.61771206 L36.2837977,7.61771206 Z" id="Fill-6" fill="#FFFFFE"></path>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                        </a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <!-- HERO IMAGE -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              	<td class="padding" align="center">
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200px" height="182px" viewBox="0 0 48 43"> <!-- Generator: Sketch 46.2 (44496) - http://www.bohemiancoding.com/sketch -->
                                    <g id="Designs" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Our-Services" transform="translate(-1195.000000, -1150.000000)" fill-rule="nonzero" fill="#bb272c">
                                      <g id="Service-Copy-3" transform="translate(735.000000, 1103.000000)">
                                        <g id="heart-pulse" transform="translate(460.000000, 47.000000)">
                                          <path d="M24,43 C23.7877895,43 23.5781053,42.9468824 23.3861053,42.8406471 C23.0930526,42.6762353 16.1178947,38.7657647 9.82231579,32.5155882 C9.32715789,32.0248824 9.32463158,31.2230588 9.81473684,30.7272941 C10.3048421,30.2315294 11.1056842,30.229 11.6008421,30.7197059 C16.6004211,35.6824118 22.176,39.1831176 24,40.2707647 C25.8265263,39.1805882 31.4071579,35.6748235 36.3991579,30.7197059 C36.8943158,30.229 37.6951579,30.2315294 38.1852632,30.7272941 C38.6753684,31.2230588 38.6728421,32.0248824 38.1776842,32.5155882 C31.8795789,38.7657647 24.9069474,42.6762353 24.6138947,42.8406471 C24.4218947,42.9468824 24.2122105,43 24,43 Z" id="Shape">
                                          </path>
                                          <path d="M3.23115789,22.7647059 C2.75621053,22.7647059 2.30147368,22.4965882 2.08673684,22.0387647 C0.702315789,19.092 0,16.1452353 0,13.2794118 C0,5.95676471 5.94947368,-3.26536184e-16 13.2631579,-3.26536184e-16 C15.7389474,-3.26536184e-16 18.3688421,0.928294118 20.6677895,2.61541176 C22.0117895,3.60188235 23.1562105,4.79070588 24,6.05288235 C24.8437895,4.79070588 25.9882105,3.60188235 27.3322105,2.61541176 C29.6311579,0.928294118 32.2610526,-8.8817842e-16 34.7368421,-8.8817842e-16 C42.0505263,-8.8817842e-16 48,5.95676471 48,13.2794118 C48,16.1452353 47.2976842,19.092 45.9132632,22.0387647 C45.6151579,22.6711176 44.8648421,22.9417647 44.2332632,22.6458235 C43.6016842,22.3498824 43.3313684,21.5961176 43.6269474,20.9637647 C44.8522105,18.3559412 45.4736842,15.7708824 45.4736842,13.2819412 C45.4736842,7.35552941 40.656,2.53194118 34.7368421,2.53194118 C30.4345263,2.53194118 26.256,6.07564706 25.1974737,9.25511765 C25.0256842,9.77111765 24.5431579,10.1201765 24,10.1201765 C23.4568421,10.1201765 22.9743158,9.77111765 22.8025263,9.25511765 C21.744,6.07564706 17.5654737,2.53194118 13.2631579,2.53194118 C7.344,2.53194118 2.52631579,7.35552941 2.52631579,13.2819412 C2.52631579,15.7708824 3.14778947,18.3559412 4.37305263,20.9637647 C4.67115789,21.5961176 4.39831579,22.3498824 3.76673684,22.6458235 C3.59242105,22.7267647 3.41052632,22.7672353 3.23115789,22.7672353 L3.23115789,22.7647059 Z" id="Shape">
                                          </path>
                                          <path d="M26.5642105,32.8823529 C26.5515789,32.8823529 26.5414737,32.8823529 26.5313684,32.8823529 C26.0210526,32.8722353 25.0938947,32.6066471 24.6290526,30.9448235 L21.5545263,19.9823529 L19.5157895,28.2762941 C19.1166316,29.9027059 18.1894737,30.2441765 17.6715789,30.2998235 C17.1536842,30.3554706 16.176,30.2315294 15.4256842,28.7315882 L13.8947368,25.6684706 C13.8214737,25.5217647 13.7532632,25.4307059 13.7027368,25.3725294 C13.6951579,25.3826471 13.6850526,25.3952941 13.6749474,25.4104706 C12.7402105,26.7839412 10.6635789,27.821 8.84210526,27.821 L6.31578947,27.821 C5.61852632,27.821 5.05263158,27.2544118 5.05263158,26.5562941 C5.05263158,25.8581765 5.61852632,25.2915882 6.31578947,25.2915882 L8.84210526,25.2915882 C9.90568421,25.2915882 11.1688421,24.6035882 11.5882105,23.9864118 C12.1515789,23.1592941 12.9701053,22.7191765 13.8391579,22.7773529 C14.784,22.8405882 15.6277895,23.4830588 16.1557895,24.5378235 L17.28,26.789 L19.6446316,17.1696471 C20.0437895,15.5508235 20.8623158,15.1992353 21.4787368,15.1891176 C22.0951579,15.179 22.9237895,15.5052941 23.376,17.1114706 L26.6197895,28.6860588 L29.5957895,19.5599412 C30.1136842,17.9714706 31.0661053,17.6982941 31.5865263,17.6755294 C32.1069474,17.6527647 33.0770526,17.8475294 33.7263158,19.3879412 L35.5553684,23.736 C35.8989474,24.5504706 37.0155789,25.2941176 37.8972632,25.2941176 L41.6867368,25.2941176 C42.384,25.2941176 42.9498947,25.8607059 42.9498947,26.5588235 C42.9498947,27.2569412 42.384,27.8235294 41.6867368,27.8235294 L37.8972632,27.8235294 C36.0101053,27.8235294 33.9587368,26.4601765 33.2261053,24.7174118 L31.7305263,21.1610588 L28.512,31.0257647 C27.9890526,32.6294118 27.0821053,32.8798235 26.5642105,32.8798235 L26.5642105,32.8823529 Z" id="Shape">
                                          </path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding">Your Monthly Activity Report. <?php echo date('F, Y'); ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">We like to keep all our WordCare customers in the loop and up to date with the work we are doing on your WordPress site.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <!-- BULLETPROOF BUTTON -->
                                    <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="padding-top: 25px;" class="padding">
                                                <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                                    <tr>
                                                    	<td align="center" style="border-radius: 3px;" bgcolor="#256F9C"><a href="https://litmus.com" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;" class="mobile-button">Learn More &rarr;</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table> -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>

<?php $log = get_option('tend_plugin_update_log'); if($log) { ?>

    <tr>
        <td bgcolor="#F5F7FA" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <!-- TITLE SECTION AND COPY -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333;" class="padding">Recent Plugin Updates</td>
                            </tr>
                            <tr>
                                <td align="center" style="padding: 20px 0 20px 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">Here are the plugins we have updated for you.</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                </table>

                <table border="0" cellpadding="10" cellspacing="0" width="100%" style="max-width: 500px; padding: 0 0 10px 0; font-size: 14px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="responsive-table">
                  <?php




                  $count = count($log);

                  echo '<th style="text-align: left;">Year</th><th style="text-align: left;">Month</th><th style="text-align: left;">Updates Completed ('.$count.')</th>';

                  $newestFirst = array_reverse($log);

                  foreach($newestFirst as $entry){
                    echo $entry;
                  }

                  ?>

                </table>

        </td>
    </tr>

<?php } ?>

<?php $Corelog = get_option('tend_core_update_log'); if($Corelog) { ?>

    <tr>
        <td bgcolor="#E6E9ED" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">

          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
              <tr>
                  <td>
                      <!-- TITLE SECTION AND COPY -->
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333;" class="padding">Recent Core Updates</td>
                          </tr>
                          <tr>
                              <td align="center" style="padding: 20px 0 20px 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">WordPress Core has been updated for you.</td>
                          </tr>
                      </table>
                  </td>
              </tr>

              </table>

              <table border="0" cellpadding="10" cellspacing="0" width="100%" style="max-width: 500px; padding: 0 0 10px 0; font-size: 14px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="responsive-table">
                <?php




                $count = count($Corelog);

                echo '<th style="text-align: left;">Year</th><th style="text-align: left;">Month</th><th style="text-align: left;">Updates Completed ('.$count.')</th>';

                $newestFirst = array_reverse($Corelog);

                foreach($newestFirst as $entry){
                  echo $entry;
                }

                ?>

              </table>


        </td>
    </tr>

<?php } ?>


    <tr>
        <td bgcolor="#FFFFFF" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-bottom: 20px; max-width: 500px;" class="responsive-table">
                <!-- TITLE -->
                <tr>
                    <td align="center" style="padding: 0 0 10px 0; font-size: 25px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="padding" colspan="2">Website Security</td>
                </tr>
                <tr>
                    <td align="center" style="padding:30px 0 10px 0; font-size: 18px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="padding" colspan="2">
                      <?php
                      if(isset($_SERVER['HTTPS'])) {
                        if ($_SERVER['HTTPS'] == "on") {
                              echo '
                              <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                              <path d="M18.5 14h-0.5v-6c0-3.308-2.692-6-6-6h-4c-3.308 0-6 2.692-6 6v6h-0.5c-0.825 0-1.5 0.675-1.5 1.5v15c0 0.825 0.675 1.5 1.5 1.5h17c0.825 0 1.5-0.675 1.5-1.5v-15c0-0.825-0.675-1.5-1.5-1.5zM6 8c0-1.103 0.897-2 2-2h4c1.103 0 2 0.897 2 2v6h-8v-6z"></path>
                              </svg>';
                              echo ' Your site is served over HTTPS.';
                        }
                      } ?>
                    </td>
                </tr>

                  </table>

        </td>
    </tr>

    <?php $PageSpeed = get_option('tend_page_load_time');

    if($PageSpeed) {
    ?>

    <tr>
        <td bgcolor="#E6E9ED" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-bottom: 20px; max-width: 500px;" class="responsive-table">
                <!-- TITLE -->
                <tr>
                    <td align="center" style="padding: 0 0 10px 0; font-size: 25px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="padding" colspan="2">Website Performance</td>
                </tr>

                <tr>
                    <td align="center" style="padding:30px 0 10px 0; line-height:1.5em;font-size: 18px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="padding" colspan="2">

                      <?php
                      $testResults = get_option('tend_GT_metrix_test');
                      $reportTime = $testResults['timeStamp'];
                      echo 'Date of last test: '  . date( "d F Y", $reportTime) . '<br />';
                      echo 'PageSpeed Score: ' . $testResults['pagespeedScore'] . '%<br />';
                      $loadTime = ($testResults['fullyLoadedTime'] / 1000);
                      echo 'Fully Loaded Time: ' . round($loadTime , 1)  . ' seconds<br/>';
                      echo '<a target="_blank" href="' . $testResults['reportUrl']. '">View Full Perfomance Report</a>';
                      ?>

                </td>
              </tr>

                  </table>

        </td>
    </tr>

<?php } ?>



    <tr>
        <td bgcolor="#F5F7FA" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-bottom: 20px; max-width: 500px;" class="responsive-table">
                <!-- TITLE -->
                <tr>
                    <td align="center" style="padding: 0 0 10px 0; font-size: 25px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="padding" colspan="2">Whats New at 10°</td>
                </tr>
                <tr>
                    <td align="center" style="padding:10px;" class="padding" colspan="2"><a href="https://www.10degrees.uk/blog/">
                      <img style="max-width:500%; width:100%; height:auto" src="https://10degrees.uk/wp-content/uploads/2017/06/10d-team.jpg" alt="Picture of the 10 Degrees team" />
                    </a></td>
                </tr>
                <tr>
                    <td align="center">
                       <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" style="padding-top: 25px;" class="padding">
                                    <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                        <tr>
                                          <td align="center" style="border-radius: 3px;" bgcolor="#bb272c"><a href="https://www.10degrees.uk/blog/" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #bb272c; display: inline-block;" class="mobile-button">Check out our blog for the latest updates and news from the 10° team &rarr;</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

              </table>

        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 20px 0px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <!-- UNSUBSCRIBE COPY -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                        <a href="https://10degrees.uk">10° WordPress Specialists</a><br />
                        <?php $sitename = get_bloginfo('url'); ?>
                        <a href="mailto:support@10degrees.uk?subject=Cancel%20Report%20for%20<?php echo $sitename; ?>&body=Please%20do%20not%20send%20me%20this%20report%20anymore">I do not wish to recieve this report</a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>
</body>
</html>
