<?php
	include('top.php');
?>	

<h1>Kalender</h1>
<ol class="calendar" start="6">
	<li id="labels">
		<ol>
			<li>Monday</li>
			<li>Tuesday</li>
			<li>Wedsday</li>
			<li>Thursday</li>
			<li>Friday</li>
			<li>Saturday</li>
			<li>Sunday</li>
		</ol>
	</li>
	<li id="lastmonth">
		<ol start="29">
			<li>29</li>
			<li>30</li>
		</ol>
	</li>
	<li id="thismonth">
		<ol>
			<li>1</li>
			<li>2</li>
			<li>3</li>
			<li>4</li>
			<li>5</li>
			<li>6</li>
			<a href="pancakes.php"><li id="pancake">7</li></a>
			<li>8</li>
			<li>9</li>
			<li>10</li>
			<li>11</li>
			<li>12</li>
			<li>13</li>
			<li>14</li>
			<li>15</li>
			<a href="meatballs.php"><li id="meatball">16</li></a>
			<li>17</li>
			<li>18</li>
			<li>19</li>
			<li>20</li>
			<li>21</li>
			<li>22</li>
			<li>23</li>
			<li>24</li>
			<li>25</li>
			<li>26</li>
			<li>27</li>
			<li>28</li>
			<li>29</li>
			<li>30</li>
			<li>31</li>
		</ol>
	</li>
	<li id="nextmonth">
		<ol>
			<li>1</li>
			<li>2</li>
		</ol>
	</li>
</ol>

<?php	
	include('bot.php');
?>