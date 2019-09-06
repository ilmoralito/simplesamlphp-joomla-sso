<?php

// metadata/saml20-sp-remote.php

/**
 * SAML 2.0 remote SP metadata for SimpleSAMLphp.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-sp-remote
 */

/*
 * Example SimpleSAMLphp SAML 2.0 SP
 */

//
//  $metadata['https://saml2sp.example.org'] = [
//     'AssertionConsumerService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
//     'SingleLogoutService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
// ];
//

/*
 * This example shows an example config that works with G Suite (Google Apps) for education.
 * What is important is that you have an attribute in your IdP that maps to the local part of the email address at
 * G Suite. In example, if your Google account is foo.com, and you have a user that has an email john@foo.com, then you
 * must set the simplesaml.nameidattribute to be the name of an attribute that for this user has the value of 'john'.
 */

//
// $metadata['google.com'] = [
//     'AssertionConsumerService' => 'https://www.google.com/a/g.feide.no/acs',
//     'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
//     'simplesaml.nameidattribute' => 'uid',
//     'simplesaml.attributes' => false,
// ];
//

//
// $metadata['https://legacy.example.edu'] = [
//     'AssertionConsumerService' => 'https://legacy.example.edu/saml/acs',
    /*
     * Currently, SimpleSAMLphp defaults to the SHA-256 hashing algorithm.
     * Uncomment the following option to use SHA-1 for signatures directed
     * at this specific service provider if it does not support SHA-256 yet.
     *
     * WARNING: SHA-1 is disallowed starting January the 1st, 2014.
     * Please refer to the following document for more information:
     * http://csrc.nist.gov/publications/nistpubs/800-131A/sp800-131A.pdf
     */
    //'signature.algorithm' => 'http://www.w3.org/2000/09/xmldsig#rsa-sha1',
//
// ];
//

$metadata['https://simplesamlphp.local/simplesaml'] = array (
  'SingleLogoutService' =>
  array (
    0 =>
    array (
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://simplesamlphp.local/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
    ),
  ),
  'AssertionConsumerService' =>
  array (
    0 =>
    array (
      'index' => 0,
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://simplesamlphp.local/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
    ),
    1 =>
    array (
      'index' => 1,
      'Binding' => 'urn:oasis:names:tc:SAML:1.0:profiles:browser-post',
      'Location' => 'https://simplesamlphp.local/simplesaml/module.php/saml/sp/saml1-acs.php/default-sp',
    ),
    2 =>
    array (
      'index' => 2,
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Artifact',
      'Location' => 'https://simplesamlphp.local/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
    ),
    3 =>
    array (
      'index' => 3,
      'Binding' => 'urn:oasis:names:tc:SAML:1.0:profiles:artifact-01',
      'Location' => 'https://simplesamlphp.local/simplesaml/module.php/saml/sp/saml1-acs.php/default-sp/artifact',
    ),
  ),
  'contacts' =>
  array (
    0 =>
    array (
      'emailAddress' => 'amakenadog@gmail.com',
      'contactType' => 'technical',
      'givenName' => 'Administrator',
    ),
  ),
  'certData' => 'MIIFGTCCA4GgAwIBAgIUX5pFZ/nocXXOuXci5EbGjIgZYkEwDQYJKoZIhvcNAQELBQAwgZsxCzAJBgNVBAYTAkFVMRAwDgYDVQQIDAdNYW5hZ3VhMRAwDgYDVQQHDAdNYW5hZ3VhMQwwCgYDVQQKDANQUFcxCzAJBgNVBAsMAklUMRwwGgYDVQQDDBNzaW1wbGVzYW1scGhwLmxvY2FsMS8wLQYJKoZIhvcNAQkBFiBtYXJpby5tYXJ0aW5lekBwZW9wbGV3YWxraW5nLmNvbTAeFw0xOTA5MDQxOTIxMzBaFw0yOTA5MDMxOTIxMzBaMIGbMQswCQYDVQQGEwJBVTEQMA4GA1UECAwHTWFuYWd1YTEQMA4GA1UEBwwHTWFuYWd1YTEMMAoGA1UECgwDUFBXMQswCQYDVQQLDAJJVDEcMBoGA1UEAwwTc2ltcGxlc2FtbHBocC5sb2NhbDEvMC0GCSqGSIb3DQEJARYgbWFyaW8ubWFydGluZXpAcGVvcGxld2Fsa2luZy5jb20wggGiMA0GCSqGSIb3DQEBAQUAA4IBjwAwggGKAoIBgQDAFr01yuB1/QQwY5RAxv0brEYVoM78Oq6TcQlYM5BD8Vv3fLTjpKILciD7VvxF3QAojcb1Poa9vupJENqWXnpv7gzNzlkor3MNBVV0Pj8Bn2lvIczzJTocMgHXG460pIjI9RjVS0QZNVldvhmjZ7JHsyM9VVyYvYGh7h9RksgvqSFMHrkq1WSaeUNHmiIYkod+yutfy31LOtsz/KCOUCmpYW7jpx2YcbKnysrSPsDbfwGNFCzlJOb/Q1tF2BuzyxAeVyH4Q88Rh+KLzjS0ukTFiWj26u+WVxuFl16u4bIZbZjMlzU3FZLzuuAsBSh0hpyadmNrae3eyR+y2aD/yaOjN/SpRwpoIyfWyyclNko6QzxN3+l7dFVZo2yDSq+Z8PctP2S2R54ogWKQVhCCds59QKAEvFBhbBH9PyidI+5JzZl82XmTMn6WqHg15Earj5xXjS+XnJWQafZbQrm1RJD015yWdkjPickjyLtXSK+P+XbmIqxQt6VDQDMczx0wx8cCAwEAAaNTMFEwHQYDVR0OBBYEFNlFLL1lh5poQJs99oIUqsAjUMKjMB8GA1UdIwQYMBaAFNlFLL1lh5poQJs99oIUqsAjUMKjMA8GA1UdEwEB/wQFMAMBAf8wDQYJKoZIhvcNAQELBQADggGBAADOn073Qlct4mkGEH6on+2EZoyhf6RM1Tk3lDzXrbcOTxPKeUiSnXFXDObhDOzwEb2O7mMrVg9EHlMHDf4mhdwAqoMM06NB/D10Vghv20QShV/ZR8S6ePYbRbXxKR0xGcbIJGIIhwbMc+iG2yVDVegpRiPH/xxBcJYY3G1p7G+CwN+d9Ho7vNPvmcgheNN4JjRB7bVkoyAHoEbq0p9pNlfaYpIYktY/tfNQ872vGQzbpD+nl20w3bdSX0wdLJGp/m3AnehXciBzpYsNlbntF50emlLGylf1ARYTS5xwQv7fNd8Agf/3P1/AXQZ6Cl7pk3B8sVYpBPoMYbzYOmRk8AciUtH6IJFLRrz6c+3zsh+HlHIsfXX8XkuHtSa2STq0dnw35icJUxjbTKyNoWGFD6xdm8lXQYoKBBFncCUG3UmZSg0tGb9Uaxfd977YhevvIYTr6EE4pSNGqNir5F9DsSqD/FroGCj1p6xo0CJzHwFDFjvOzOhwTqtWpKHBj1/+5g==',
);
