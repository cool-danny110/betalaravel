@extends('layouts.app')
<title>ACCOUNT : My Account</title>
@section('content')
<div class="content">
    <div class="my_box">

    <div class="box_head">
        <div class="item">
        <h1>My Account</h1>
        </div>
        
    </div>

    <div class="box_body account">

    <style>
    .account .nav {
    width: 100%;
    }

    input[type=text],
    input[type=password],
    input[type=number],
    input[type=email],
    input[type=tel], select {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .account .nav-link {
    color:#666 !important;
    }

    .form__legend {
    font-size: 1.14869835rem;
    line-height: 1.5rem;
    font-weight: 700;
    padding-right: 2.5rem;
    }

    .form__entries, .form__legend {
    display: table-cell;
    margin: 0;
    padding-top: 4rem;
    vertical-align: top;
    }

    .entry__label {
    display: table;
    font-weight: 700;
    padding: 0;
    white-space: normal;
    }

    .form__row {
    display: -webkit-flex;
    display: flex;
    -webkit-flex-wrap: wrap;
    flex-wrap: wrap;
    }

    .form__entry {
    padding: 0 10px;
    margin: 0;
    }

    .pd-010 {
    padding: 0 10px;
    }

    .panel {
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    border: 1px solid #c0ccda;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border-radius: 0.1875rem;
    }

    </style>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
    <button class="nav-link active" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">Information</button>
    </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Password</button>
    </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="legal-documents-tab" data-bs-toggle="tab" data-bs-target="#legal-documents" type="button" role="tab" aria-controls="legal-documents" aria-selected="false">Legal Documents</button>
    </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="home-tab">


    <div id="profile_form" class="tab_forms" style="display: block;">
    <form name="update_profile" method="post" class="form_fieldset" onsubmit="return profileValidator.validate(this);" novalidate="novalidate" _lpchecked="1">
    <div class="notification notification_warning collapsible collapsible__content" id="warning_notification" data-collapsible-behavior="shutter" data-speed-divisor="5" style="display:none">
    <div class="notification__content">
    <svg viewBox="0 0 512 512" class="icon notification__icon">
    <path d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm42-104c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42zm-81.37-211.401l6.8 136c.319 6.387 5.591 11.401 11.985 11.401h41.17c6.394 0 11.666-5.014 11.985-11.401l6.8-136c.343-6.854-5.122-12.599-11.985-12.599h-54.77c-6.863 0-12.328 5.745-11.985 12.599z"></path>
    </svg>
    Please fill in all the fields to complete your profile
    </div>
    <div class="notification__actions">
    <button type="button" class="notification__closer collapsible__trigger" aria-label="🗙"></button>
    </div>
    </div>
    <section class="form__fieldset">
    <h2 class="form__legend" id="personal__info_label">Personal information</h2>
    <div class="form__entries" id="personal__info_details">

    <div class="form__row">
    <div class="form__entry" >
    <label for="update_profile_givenName" class="entry__label">First name
    </label>
    <div class="entry__field"><input type="text" id="update_profile_givenName" name="update_profile[givenName]" required="required" autocomplete="given-name" class=" input" value="Max"></div>
    </div>
    <div class="form__entry" >
    <label for="update_profile_familyName" class="entry__label">Last name
    </label>
    <div class="entry__field"><input type="text" id="update_profile_familyName" name="update_profile[familyName]" required="required" autocomplete="family-name" class=" input" value="Payne"></div>
    </div>
    </div>


    <div class="form__row mt-15">
    <div class="form__entry">
    <label for="update_profile_email" class="entry__label">Email address
    </label>
    <div class="entry__field"><input type="text" id="update_profile_email" name="update_profile[email]" required="required" autocomplete="email" data-violation="This value is not a valid email address."  class=" input" value="peter@msbx.co.uk"></div>
    </div>
    </div>

    <div class="form__row mt-15">
    <div class="form__entry">
    <label for="phone_number" class="entry__label">Phone Number
    </label>
    <div class="entry__field"><input type="tel" id="update_profile_phoneNumber_number" name="update_profile[phoneNumber][number]" required="required" class=" input" value="7809671303"></div>
    </div>
    </div>






    </div>
    </section>
    <section class="form__fieldset">
    <h2 class="form__legend" style="padding-top: 4rem;">Company information</h2>
    <div class="form__entries">
    <div class="form__row">
    <div class="form__entry">
    <label for="update_profile_organizationData_organizationName" class="entry__label">Company / Organization
    </label>
    <div class="entry__field"><input type="text" id="update_profile_organizationData_organizationName" name="update_profile[organizationData][organizationName]" required="required" autocomplete="organization" class=" input" value="E15 Net Cafe"></div>
    </div>
    <div class="form__entry">
    <label for="update_profile_organizationData_websiteUrl" class="entry__label">Website
    </label>
    <div class="entry__field"><input type="text" id="update_profile_organizationData_websiteUrl" name="update_profile[organizationData][websiteUrl]" required="required" autocomplete="url" placeholder="https://" class=" input" value="www.einfluencer.co"></div>
    </div>
    </div>
    <div class="form__row mt-15">
    <div class="form__entry">
    <label for="update_profile_organizationData_streetAddress" class="entry__label">Street address
    </label>
    <div class="entry__field"><input type="text" id="update_profile_organizationData_streetAddress" name="update_profile[organizationData][streetAddress]" required="required" autocomplete="street-address" class=" input" value="Vicarage Lane 33"></div>
    </div>
    </div>
    <div class="form__row mt-15">
    <div class="form__entry" >
    <label for="update_profile_organizationData_postalCode" class="entry__label">ZIP Code
    </label>
    <div class="entry__field"><input type="text" id="update_profile_organizationData_postalCode" name="update_profile[organizationData][postalCode]" required="required" autocomplete="postal-code" class=" input" value="E15 4HG"></div>
    </div>
    <div class="form__entry" >
    <label for="update_profile_organizationData_locality" class="entry__label">City
    </label>
    <div class="entry__field"><input type="text" id="update_profile_organizationData_locality" name="update_profile[organizationData][locality]" required="required" autocomplete="address-level2" class=" input" value="London"></div>
    </div>
    </div>
    <div class="form__row mt-15">
    <div class="form__entry">
    <label for="update_profile_organizationData_countryCode" class="entry__label">Country
    </label>
    <div class="entry__field"><input id="autocomplete-input" class="input" type="text" required="required" autocomplete="autocomplete-input" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;"><select id="update_profile_organizationData_countryCode" name="update_profile[organizationData][countryCode]" required="required" autocomplete="country" class="autocomplete_selector input" data-language="en" onchange="gtmCountrySelectedTracking(this)" style="display: none;"><option value=""></option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua &amp; Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia &amp; Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="VG">British Virgin Islands</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="IC">Canary Islands</option><option value="CV">Cape Verde</option><option value="BQ">Caribbean Netherlands</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo - Brazzaville</option><option value="CD">Congo - Kinshasa</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="HR">Croatia</option><option value="CW">Curaçao</option><option value="CY">Cyprus</option><option value="CZ">Czechia</option><option value="CI">Côte d’Ivoire</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="SZ">Eswatini</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard &amp; McDonald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong SAR China</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao SAR China</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar (Burma)</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MK">North Macedonia</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestinian Territories</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn Islands</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option value="RE">Réunion</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SX">Sint Maarten</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia &amp; South Sandwich Islands</option><option value="KR">South Korea</option><option value="SS">South Sudan</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="BL">St. Barthélemy</option><option value="SH">St. Helena</option><option value="KN">St. Kitts &amp; Nevis</option><option value="LC">St. Lucia</option><option value="MF">St. Martin</option><option value="PM">St. Pierre &amp; Miquelon</option><option value="VC">St. Vincent &amp; Grenadines</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard &amp; Jan Mayen</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syria</option><option value="ST">São Tomé &amp; Príncipe</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad &amp; Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks &amp; Caicos Islands</option><option value="TV">Tuvalu</option><option value="UM">U.S. Outlying Islands</option><option value="VI">U.S. Virgin Islands</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB" selected="selected">United Kingdom</option><option value="US" aria-controls="update_profile_organizationData_countryCode_stateCode">United States</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican City</option><option value="VN">Vietnam</option><option value="WF">Wallis &amp; Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option><option value="AX">Åland Islands</option></select></div>
    </div>
    <fieldset class="form__entry choice__form" id="update_profile_organizationData_countryCode_stateCode" disabled="" style="width: 19.25em;">
    <label for="update_profile_organizationData_stateCode" class="entry__label">State
    <span class="entry__optional-indicator" style="display: none;">(optional)</span></label>
    <div class="entry__field"><select id="update_profile_organizationData_stateCode" name="update_profile[organizationData][stateCode]" class=" input"><option value="">Select State</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AS">American Samoa</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FM">Federated States Of Micronesia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="GU">Guam</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MH">Marshall Islands</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="MP">Northern Mariana Islands</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PW">Palau</option><option value="PA">Pennsylvania</option><option value="PR">Puerto Rico</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VI">Virgin Islands</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyomin</option></select></div>
    </fieldset>
    </div>
    </div>
    </section>
    <section class="form__fieldset">
    <h2 class="form__legend">Newsletter</h2>
    <div class="form__entries profile_terms_checkbox">
    <div class="form__entry">
    <div class="entry__choice">
    <label>
    <input type="checkbox" id="update_profile_askedForNewsletter" name="update_profile[askedForNewsletter]" class=" input_replaced" value="1">
    <span class="checkbox checkbox_tick_positive "></span>
    I want to receive HybridMail newsletter to receive Product updates and Marketing tips.
    </label>
    </div>
    </div>
    </div>
    </section>
    <section class="form__fieldset">
    <br>
    <div class="mt-15">
    <button type="submit" id="update_profile_submit" name="update_profile[submit]" class="my_but"><svg id="pattern_loader" class="icon clickable__icon progress-indicator__icon" viewBox="0 0 512 512" style="display:none;">
    <path d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z"></path>
    </svg>
    Update my profile
    </button>
    </div>
    </section>
    <input type="hidden" id="talon" name="update_profile[eHawkTalon]" class=" input" value="{&quot;version&quot;: &quot;5.8&quot;, &quot;status&quot;: 0, &quot;timestamp&quot;: &quot;Sun, 13 Mar 2022 20:05:46 GMT&quot;, &quot;a&quot;: {&quot;dst&quot;: false, &quot;tzo&quot;: 0, &quot;stzo&quot;: 0}, &quot;b&quot;: &quot;en-US&quot;, &quot;c&quot;: 309365676, &quot;d&quot;: &quot;en&quot;,&quot;e&quot;: &quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31&quot;, &quot;0&quot;: 1,  &quot;3&quot;: &quot;bea0efdf7676251101009b4d19e77781&quot;, &quot;4&quot;: &quot;&quot;, &quot;7&quot;: &quot;0&quot;,&quot;8&quot;:&quot;1&quot;,&quot;6&quot;:&quot;1&quot;, &quot;9&quot;:&quot;0&quot;,&quot;2&quot;:3176814043, &quot;5&quot;: &quot;1647201947059&quot;}"><input type="hidden" id="update_profile__token" name="update_profile[_token]" class=" input" value="Td0rtNOvRX2Yf-3MVpjhIGOvFU_NbwwDQLTXLXlk0h8"></form>
    <script src="https://assets.sendinblue.com/js/EHawkTalon.js" defer=""></script><script>document.addEventListener("DOMContentLoaded",function(){eHawkTalon()})</script></div>

    </div>




    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">




    <div id="password_form" class="tab_forms" style="display: block;">
    <form name="change_password" method="post" class="form_fieldset">
    <section class="form__fieldset">
    <h2 class="form__legend">Password</h2>
    <div class="form__entries">
    <div class="form__row">
    <div class="form__entry" style="width: 19.25em;">
    <label for="change_password_currentPassword" class="entry__label">Current password
    </label>
    <div class="entry__field"> <input type="password" id="change_password_currentPassword" name="change_password[currentPassword]" required="required" autocomplete="off" class=" input" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAUBJREFUOBGVVE2ORUAQLvIS4gwzEysHkHgnkMiEc4zEJXCMNwtWTmDh3UGcYoaFhZUFCzFVnu4wIaiE+vvq6+6qTgthGH6O4/jA7x1OiCAIPwj7CoLgSXDxSjEVzAt9k01CBKdWfsFf/2WNuEwc2YqigKZpK9glAlVVwTTNbQJZlnlCkiTAZnF/mePB2biRdhwHdF2HJEmgaRrwPA+qqoI4jle5/8XkXzrCFoHg+/5ICdpm13UTho7Q9/0WnsfwiL/ouHwHrJgQR8WEwVG+oXpMPaDAkdzvd7AsC8qyhCiKJjiRnCKwbRsMw9hcQ5zv9maSBeu6hjRNYRgGFuKaCNwjkjzPoSiK1d1gDDecQobOBwswzabD/D3Np7AHOIrvNpHmPI+Kc2RZBm3bcp8wuwSIot7QQ0PznoR6wYSK0Xb/AGVLcWwc7Ng3AAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
    <!--
    <button type="button" class="input__affix input__button input__password-toggler" tabindex="-1" aria-controls="change_password_currentPassword" aria-pressed="false">
    <svg viewBox="0 0 24 24" class="icon">
    <title>Toggle password visibility</title>
    <path fill="none" d="M0 0h24v24H0z"></path>
    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>
    </svg>
    </button>
    -->
    </div>
    </div>
    </div>
    <div class="form__row mt-15">
    <div class="form__entry">
    <label for="change_password_newPassword" class="entry__label">New password
    </label>
    <div class="entry__field"> <input type="password" id="change_password_newPassword" name="change_password[newPassword]" required="required" autocomplete="new-password" class=" input" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACIUlEQVQ4EX2TOYhTURSG87IMihDsjGghBhFBmHFDHLWwSqcikk4RRKJgk0KL7C8bMpWpZtIqNkEUl1ZCgs0wOo0SxiLMDApWlgOPrH7/5b2QkYwX7jvn/uc//zl3edZ4PPbNGvF4fC4ajR5VrNvt/mo0Gr1ZPOtfgWw2e9Lv9+chX7cs64CS4Oxg3o9GI7tUKv0Q5o1dAiTfCgQCLwnOkfQOu+oSLyJ2A783HA7vIPLGxX0TgVwud4HKn0nc7Pf7N6vV6oZHkkX8FPG3uMfgXC0Wi2vCg/poUKGGcagQI3k7k8mcp5slcGswGDwpl8tfwGJg3xB6Dvey8vz6oH4C3iXcFYjbwiDeo1KafafkC3NjK7iL5ESFGQEUF7Sg+ifZdDp9GnMF/KGmfBdT2HCwZ7TwtrBPC7rQaav6Iv48rqZwg+F+p8hOMBj0IbxfMdMBrW5pAVGV/ztINByENkU0t5BIJEKRSOQ3Aj+Z57iFs1R5NK3EQS6HQqF1zmQdzpFWq3W42WwOTAf1er1PF2USFlC+qxMvFAr3HcexWX+QX6lUvsKpkTyPSEXJkw6MQ4S38Ljdbi8rmM/nY+CvgNcQqdH6U/xrYK9t244jZv6ByUOSiDdIfgBZ12U6dHEHu9TpdIr8F0OP692CtzaW/a6y3y0Wx5kbFHvGuXzkgf0xhKnPzA4UTyaTB8Ph8AvcHi3fnsrZ7Wore02YViqVOrRXXPhfqP8j6MYlawoAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
    <!--
    <button type="button" class="input__affix my_but input__password-toggler" tabindex="-1" aria-controls="change_password_newPassword" aria-pressed="false">
    <svg viewBox="0 0 24 24" class="icon">
    <title>Toggle password visibility</title>
    <path fill="none" d="M0 0h24v24H0z"></path>
    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>
    </svg>
    </button>
    -->
    </div>
    </div>
    </div>

    <div class="mt-15 pd-010"><button type="submit" id="change_password_submit" name="change_password[submit]" class="my_but">Update my password</button></div>
    </div>
    </section>
    <input type="hidden" id="change_password__token" name="change_password[_token]" class=" input" value="cgRxieWLngiVxrdLBXhjC07ese9ojDaNFo4aMZD1L_k"></form>
    </div>


    </div>




    <div class="tab-pane fade" id="legal-documents" role="tabpanel" aria-labelledby="legal-documents-tab">



    <div style="margin-top: 2.5rem;"><div class="row"><div class="col_6"><h2 class="primary_heading"><span>Data Processing Agreement</span></h2><p class="primary_content"><span>Sendinblue offers a Data Processing Agreement as a means of meeting the adequacy and security requirements of the European Parliament and Council of the European Union's Data Protection Directive and the General Data Protection Regulation (GDPR).</span></p></div></div><div class="panel"><div class="row panel_block"><div class="col_6"><h4 class="panel_heading"><span>I am a legal representative and authorized to edit the DPA</span></h4><p class="panel_content"><span>Edit the form related to the processing of data in electronic form. Click on the «Edit the DPA» button and follow the instructions.</span></p></div><div class="col_6"><a class="clickable_button cta" href="/account/data-processing-agreement/form/create"><button class="my_but">Edit the DPA</button></a></div></div></div><div class="panel"><div class="panel_block" style="align-items: inherit;"><div><h4 class="panel_heading"><span>I am not a legal representative of the organization</span></h4><p class="panel_content"><span>Share the DPA form to a legal representative by email. The authorized representative will receive a temporary link to edit the DPA.</span></p></div><div><div class="representative_email"><div class="form__entry "><label class="entry__label"><span>Representative's email</span></label><div class="entry__field"><input type="email" name="shareEmail" class="input" placeholder="Insert email here" value=""></div> &nbsp; &nbsp; <button type="button" class="my_but2 clickable_ghost button_loader" disabled="" style="margin: 0.5rem 0px;"><span>Share the DPA form</span></button></div></div></div></div></div></div>




    </div>
    </div>







    </div>









    </div>
</div>
@endsection
