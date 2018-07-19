<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LittNews
 */

?>
<?php include 'sidebar-right.php'; ?>
</div>
	</div><!-- #content -->



<div class="risks">
    <div class="container">
        <div class="risks__content">
            <p>ФИНАНСОВЫЕ ОПЕРАЦИИ, ПРЕДЛАГАЕМЫЕ ДАННЫМ САЙТОМ, МОГУТ ОБЛАДАТЬ ПОВЫШЕННЫМ УРОВНЕМ РИСКА. ПРИОБРЕТАЯ ПРЕДЛАГАЕМЫЕ ДАННЫМ САЙТОМ ФИНАНСОВЫЕ УСЛУГИ И ИНСТРУМЕНТЫ, ВЫ МОЖЕТЕ ПОНЕСТИ СЕРЬЕЗНЫЕ ФИНАНСОВЫЕ ПОТЕРИ ИЛИ ПОЛНОСТЬЮ УТРАТИТЬ СРЕДСТВА, НАХОДЯЩИЕСЯ НА ВАШЕМ ГАРАНТИЙНО-ТОРГОВОМ СЧЕТУ. ПОЖАЛУЙСТА, ОЦЕНИТЕ ВСЕ ФИНАНСОВЫЕ РИСКИ И ПОСОВЕТУЙТЕСЬ С НЕЗАВИСИМЫМ ФИНАНСОВЫМ КОНСУЛЬТАНТОМ ПЕРЕД НАЧАЛОМ ТОРГОВЛИ. LITTINVEST НЕ НЕСЕТ ОТВЕТСТВЕННОСТИ ЗА ЛЮБЫЕ ПРЯМЫЕ, КОСВЕННЫЕ И СЛУЧАЙНЫЕ УБЫТКИ ИЛИ ЛЮБОЙ ДРУГОЙ УЩЕРБ, СВЯЗАННЫЙ С ДЕЙСТВИЯМИ ПОЛЬЗОВАТЕЛЯ НА ДАННОМ САЙТЕ. УСЛУГИ ПРЕДОСТАВЛЯЕТ EXPLATINUM LP</p>
            <div class="risks__urls">
                <a href="https://littinvest.online/" class="risks__link">Пользовательское соглашение</a>
                <a href="https://littinvest.online/" class="risks__policy">Политика конфиденциальности</a>
            </div>
            <p>Лицензия биржи от 17.07.2014 № 077-001, выданная МФБ Мексики.</p>
            <p class="risks__copy">Copyright &copy; LittInvest 2017. Все права защищены.</p>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-md main-modal " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <form id="activate_form" class="form-container">
                <h5 class="modal--title">ПОДПИСКА</h5>
                <h5 class="form-title_number modal--title">
                    Введите свой номер телефона для СМС-подтверждения того, что вы не робот.
                </h5>
            </form>
        </div>
    </div>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
