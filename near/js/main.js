jQuery.noConflict();
(function( $ ) {
    $(function() {

        // More code using $ as alias to jQuery

        $ ( document ).ready ( function () {

            const nearTestNet = new nearApi.Near({
                keyStore: new nearApi.keyStores.BrowserLocalStorageKeyStore(),
                networkId: 'testnet',
                nodeUrl: 'https://rpc.testnet.near.org',
                walletUrl: 'https://wallet.testnet.near.org',
                explorerUrl: "https://explorer.testnet.near.org"
            });
            const nearMainNet = new nearApi.Near({
                keyStore: new nearApi.keyStores.BrowserLocalStorageKeyStore(),
                networkId: 'mainnet',
                nodeUrl: 'https://rpc.near.org',
                walletUrl: 'https://wallet.near.org',
                explorerUrl: "https://explorer.near.org"
            });

            const walletTestNet = new nearApi.WalletConnection(nearTestNet, 'near-app');
            const walletMainNet = new nearApi.WalletConnection(nearMainNet, 'near-app');

            // let wallet = ( $ ( this ).data ( 'network' ) === 'main') ? walletMainNet : walletTestNet;
            let wallet = walletTestNet;

            if ( wallet.isSignedIn() ) {

                // wallet.signOut()

                var query = window.location.search.substring(1);

                function parse_query_string(query) {
                    var vars = query.split("&");
                    var query_string = {};
                    for (var i = 0; i < vars.length; i++) {
                        var pair = vars[i].split("=");
                        var key = decodeURIComponent(pair.shift());
                        var value = decodeURIComponent(pair.join("="));
                        // If first entry with this name
                        if (typeof query_string[key] === "undefined") {
                            query_string[key] = value;
                            // If second entry with this name
                        } else if (typeof query_string[key] === "string") {
                            var arr = [query_string[key], value];
                            query_string[key] = arr;
                            // If third or later entry with this name
                        } else {
                            query_string[key].push(value);
                        }
                    }
                    return query_string;
                }

                var qs = parse_query_string(query);

                if ( qs.transactionHashes ) {

                    $ ( '.bred-payment' ).addClass ( 'active' );

                    $ ( '.wallet-payment-hash > span' ).text( qs.transactionHashes );

                    $ ( '.main-content-wrap' ).hide();

                    $ ( '.thanks-wrap' ).show();

                    $( '.check-near-tran' ).on( 'click', function () {

                        const query = window.location.search.substring(1);

                        const qs = parse_query_string(query);

                        const ID = qs.transactionHashes;

                        let url = `${wallet._near.config.explorerUrl}/transactions/${ID}`;

                        window.open(url, '_blank');

                    });

                }

                setTimeout(
                    function()
                    {

                        $ ( '.login-page-text-wrap > div' ).hide ();
                        $ ( '.near-login-loading' ).hide ();

                        const width = $( window ).width();

                        $( ".login-page-text-wrap" ).animate({
                            width: "67px",
                        }, 1000, function() {
                            // Animation complete.
                        });

                        $( ".login-page-form-wrap" ).animate({
                            width: width,
                        }, 1000, function() {
                            $ ( '.login-page-wrap' ).addClass( 'near-background' );
                            $ ( '.near-dfetails-wrap' ).show();

                        });

                    }, 1000);

            } else {

                $ ( '.near-login-loading' ).hide ();
                $ ( '.near-login-wrap' ).show ();

            }

            $( '.near_login' ).on( 'click', function () {

                $ ( this ).parent ( 'div.near-login-wrap' ).hide ();

                $ ( this ).parent ( 'div' ).parent ( 'div' ).children ( 'div.near-login-loading' ).show ();

                wallet.requestSignIn ( $ ( this ).data ( 'address' ) );

                // alert ( 'okay' );

            });

            $ ( '.make-payment' ).on( 'click', async function () {

                $ ( this ).hide();
                $ ( '.make-payment-loading' ).show();

                const address = $ ( this ).data ( 'address' );

                let amount = parseFloat( 2 );
                if (amount < 0.001) {
                    amount = 0.001;
                }

                let payYocto = (amount * 1000).toString() + "000000000000000000000";

                wallet.account().sendMoney(address, payYocto);

                /*$ ( '.bred-payment' ).addClass ( 'active' );

                $ ( '.wallet-payment-hash > span' ).text( output.transaction.hash );

                $ ( '.main-content-wrap' ).hide();

                $ ( '.thanks-wrap' ).show();*/


                // console.log ( output );

                // alert ( 'payment dones' );

            });

            $ ( '.near-login-bind' ).on( 'click', function () {

                $ ( '.near-popup-wrap' ).show();

            });

            $ ( '#near-apply-coupon' ).on( 'click', function () {

                const value = $ ( this ).parent ( 'div' ).children ( 'input' ).val();

                if ( value == 'NEARDEMO100' ) {

                    $ ( '.near-applied-coupon' ).show();

                    $ ( '.near-applied-total' ).children ( 'b' ).text ( '2 Ⓝ' );

                }

            })

        });

    });
})(jQuery);

// Other code using $ as an alias to the other library