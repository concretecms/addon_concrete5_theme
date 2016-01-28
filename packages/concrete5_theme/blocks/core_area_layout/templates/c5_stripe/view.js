(function () {
    // We move the background image and class from data-stripe-wrapper up to the closest
    // div containing the special custom template class. Because it's this DIV that should
    // have the parallax image close to it.

    var $parallax = $('div[data-stripe-wrapper=stripe]');

    $parallax.each(function () {
        var $self = $(this);
        $wrapper = $self.closest('div.ccm-block-custom-template-c5-stripe'),
            $children = $wrapper.children(),
            $inner = $children.first();

        $wrapper.attr('data-stripe', 'parallax').attr('data-background-image', $self.attr('data-background-image'));
        $inner.addClass('parallax-stripe-inner');

        $wrapper.parallaxize({
            speed: 0.25
        });
    });

}());
