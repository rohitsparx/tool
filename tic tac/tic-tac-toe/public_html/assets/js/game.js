var game = function (element) {
    var players = ['X', 'O'];
    var ele = $(element);
    var boxes = ele.children();
    var $this = this;
    var board = new Array(9);
    var turn = 'X';
    var winner = null;
    var choice;
    var performance = 0;

//                var playerNum = 1;

    this.init = function () {
        boxes.empty();
//                    $this.shufflePlayers();
        $this.attachEventHandlers();
        $this.updateHoverUI(turn);
        if ($this.getRandomBoolean()) {
            $this.botTurn();
        }

    };

    this.attachEventHandlers = function () {
        boxes.unbind();
        boxes.click(function (e) {
            var box = $(this);
            var ind = box.index();
            if ($this.isEmpty(ind, board)) {
                if (e.clientX) {
                    AudioUtility.play('select');
                } else {
                    setTimeout(function () {
                        AudioUtility.play('bot');
                    }, 100);
                }

                board[ind] = turn;
                $this.updateBoxUI(box, turn);
                turn = $this.getEnemy();
                $this.checkWin();

                if (e.clientX) {
                    $this.botTurn();
                }

            }
        });
    };

    this.updateBoxUI = function (box, turn) {
        box.addClass('ui-' + turn);
        box.text(turn);
        $this.updateHoverUI();
    };

    this.updateHoverUI = function (show) {
        if (typeof show == "undefined") {
            show = $this.getEnemy();
        }
        boxes.removeClass('ui-hover-O ui-hover-X');
        boxes.each(function (ind) {
            if ($this.isEmpty(ind, board)) {
                $(this).addClass('ui-hover-' + show);
            }
        });
    };

    this.checkWin = function () {
//        Utility.printMatrix(board);
        winner = $this.checkWinLogic(board);

        if (winner) {
            boxes.unbind();
            if (Utility.askUser("Winner: " + winner + ". Restart Game?"))
                $this.restartGame();
        }
        $this.checkTie();
    };

    this.isBoardFull = function (board) {
        for (var i = 0; i < board.length; i++)
            if ($this.isEmpty(i, board)) {
                return false;
            }
        return true;
    };

    this.checkTie = function () {
        if ($this.isBoardFull(board)) {
            boxes.unbind();
            if (Utility.askUser("No winner: Khichadi. Restart Game?"))
                $this.restartGame();
        }
    };

    this.restartGame = function () {
//                    board = new Array(9);
//                    turn = 0;
//                    winner = null;
//                    $this.init();
        window.location.reload();
    };

    this.isEmpty = function (index, board) {
        if (typeof board[index] == "undefined") {
            return true;
        }
        return false;
    };

    this.makeEmpty = function (index) {
        board[index] = undefined;
    };

    this.botTurn = function () {
        performance = 0;
        choice = null;
//        console.time("Time");
        var $box = ele.children().eq(getBestChance()).click();
        console.log("Number of Iterations: ", performance);
//        console.timeEnd("Time");

        function getBestChance() {
            $this.miniMax(board, turn, 0);
//            console.log('choice ', choice);
            return choice;
//                        return choice.split("-")[1];
        }

    };

    this.getEnemy = function (p) {
        if (typeof p == "undefined") {
            p = turn;
        }
        return p == 'X' ? 'O' : 'X';
    };

    this.shufflePlayers = function () {
        var tempIndex = $this.getRandomBoolean();
        turn = players[tempIndex];
    };

    this.getRandomBoolean = function () {
        return Math.floor(Math.random() * 2);
    };

    this.checkWinLogic = function (arr) {
        var winner = null;
        if (arr[0] == arr[1] && arr[1] == arr[2] && arr[0] != null)
            winner = arr[0];
        if (arr[3] == arr[4] && arr[4] == arr[5] && arr[3] != null)
            winner = arr[3];
        if (arr[6] == arr[7] && arr[7] == arr[8] && arr[6] != null)
            winner = arr[6];
        if (arr[0] == arr[3] && arr[3] == arr[6] && arr[0] != null)
            winner = arr[0];
        if (arr[1] == arr[4] && arr[4] == arr[7] && arr[1] != null)
            winner = arr[1];
        if (arr[2] == arr[5] && arr[5] == arr[8] && arr[2] != null)
            winner = arr[2];
        if (arr[0] == arr[4] && arr[4] == arr[8] && arr[0] != null)
            winner = arr[0];
        if (arr[2] == arr[4] && arr[4] == arr[6] && arr[2] != null)
            winner = arr[2];
        return winner;
    };

    this.miniMax = function (board, tempTurn, depth) {
        performance++;
        var calcPoints = checkWinner(depth);
//                    console.log(calcPoints)
        if (typeof calcPoints != "undefined") {
            return calcPoints;
        }

        var scores = [], moves = [], possible_state = [];

        for (var i = 0; i < board.length; i++) {
            if ($this.isEmpty(i, board)) {
                initTempArr();
                possible_state[i] = tempTurn;
                scores.push($this.miniMax(possible_state, $this.getEnemy(tempTurn), depth + 1));
                moves.push(i);
            }
        }

        if (tempTurn == turn) {
            var max_score_index = scores.indexOf(Math.max.apply(Math, scores));
            choice = moves[max_score_index];
            return scores[max_score_index];
        }
        else if (tempTurn == $this.getEnemy(turn)) {
            var min_score_index = scores.indexOf(Math.min.apply(Math, scores));
            choice = moves[min_score_index];
            return scores[min_score_index];
        }

        function initTempArr() {
            for (var i = 0; i < 9; i++) {
                possible_state[i] = board[i];
            }
        }

        function checkWinner(depth) {
//                        console.log('a')
            var winner = $this.checkWinLogic(board);
            if (winner == turn) {
                return 100 - depth;
            }
            else if (winner == $this.getEnemy(turn)) {
                return depth - 100;
            }
            else if ($this.isBoardFull(board)) {
                return 0;
            }
        }

    };

    this.init();

};

var Utility = {
    printMatrix: function (arr) {
        console.log('Array: ');
        for (i = 0; i < 3; i++) {
            var m = arr[i * 3 + 0] ? arr[i * 3 + 0] : ' ';
            var l = arr[i * 3 + 1] ? arr[i * 3 + 1] : ' ';
            var n = arr[i * 3 + 2] ? arr[i * 3 + 2] : ' ';
            console.log(m + ' , ' + l + ' , ' + n);
        }
    },
    askUser: function (str) {
        return window.confirm(str);
    }
};

var AudioUtility = {
    sounds: {
    },
    init: function () {
        this.sounds.select = document.getElementById('Audio_Select');
        this.sounds.select.volume = 0.8;

        this.sounds.botTurn = document.getElementById('Audio_Select_bot');
        this.sounds.botTurn.volume = 0.8;
    },
    play: function (sound) {
        var $this = this;
        switch (sound) {
            case 'select':
                $this.sounds.select.play();
                break;

            case 'bot':
                $this.sounds.botTurn.play();
                break;

            default :
                console.log("Please enter sound name");

        }
    }
};

var ticTac;
$(function () {
    AudioUtility.init();
    ticTac = new game('#GameContainer');
});

